vcl 4.0;

# This is a VCL configuration file for Varnish.

backend default {
  .host = "drupal";
  .port = "80";
}

# Access control list for PURGE/BAN requests.
acl purge {
    "172.0.0.0/8";
}

sub vcl_recv {
  # Only allow PURGE requests from IP addresses in the 'purge' ACL.
  if (req.method == "PURGE") {
      if (!client.ip ~ purge) {
          return (synth(405, "Not allowed."));
      }
      return (purge);
  }

  # Only allow BAN requests from IP addresses in the 'purge' ACL.
  if (req.method == "BAN") {
      # Same ACL check as above:
      if (!client.ip ~ purge) {
          return (synth(403, "Not allowed."));
      }

      # Logic for the ban, using the Cache-Tags header. For more info
      # see https://github.com/geerlingguy/drupal-vm/issues/397.
      if (req.http.Cache-Tags) {
          ban("obj.http.Cache-Tags ~ " + req.http.Cache-Tags);
      }
      else if (req.http.X-Url) {
          ban("obj.http.X-Url ~ " + req.http.X-Url);
      }
      else {
          return (synth(403, "Cache-Tags or X-Url header missing."));
      }

      # Throw a synthetic page so the request won't go to the backend.
      return (synth(200, "Ban added."));
  }

  # Large static files are delivered directly to the end-user without
  # waiting for Varnish to fully read the file first.
  # Varnish 4 fully supports Streaming, so set do_stream in vcl_backend_response()
  if (req.url ~ "^[^?]*\.(7z|avi|bz2|flac|flv|gz|mka|mkv|mov|mp3|mp4|mpeg|mpg|ogg|ogm|opus|rar|tar|tgz|tbz|txz|wav|webm|xz|zip)(\?.*)?$") {
    unset req.http.Cookie;
    return (hash);
  }

  # Remove all cookies for static files
  # A valid discussion could be held on this line: do you really need to cache static files that don't cause load? Only if you have memory left.
  # Sure, there's disk I/O, but chances are your OS will already have these files in their buffers (thus memory).
  # Before you blindly enable this, have a read here: https://ma.ttias.be/stop-caching-static-files/
  if (req.url ~ "^[^?]*\.(7z|avi|bmp|bz2|css|csv|doc|docx|eot|flac|flv|gif|gz|ico|jpeg|jpg|js|less|mka|mkv|mov|mp3|mp4|mpeg|mpg|odt|otf|ogg|ogm|opus|pdf|png|ppt|pptx|rar|rtf|svg|svgz|swf|tar|tbz|tgz|ttf|txt|txz|wav|webm|webp|woff|woff2|xls|xlsx|xml|xz|zip)(\?.*)?$") {
    unset req.http.Cookie;
    return (hash);
  }

  # Only allow SESS, NO_CACHE, and MoodleSession cookies directly through.  All others are stripped.
  if (req.http.Cookie) {
    set req.http.Cookie = ";" + req.http.Cookie;
    set req.http.Cookie = regsuball(req.http.Cookie, "; +", ";");
    set req.http.Cookie = regsuball(req.http.Cookie, ";(SESS[a-z0-9]+|NO_CACHE|MoodleSession)=", "; \1=");
    set req.http.Cookie = regsuball(req.http.Cookie, ";[^ ][^;]*", "");
    set req.http.Cookie = regsuball(req.http.Cookie, "^[; ]+|[; ]+$", "");

    if (req.http.Cookie == "") {
      # If there are no remaining cookies, remove the cookie header. If there
      # aren't any cookie headers, Varnish's default behavior will be to cache
      # the page.
      unset req.http.Cookie;
    }
    else {
      # If there is any cookies left (a session or NO_CACHE cookie), do not
      # cache the page. Pass it on to Apache directly.
      return (pass);
    }
  }
}

# Code determining what to do when serving items from the Apache servers.
sub vcl_backend_response {
  # Don't allow static files to set cookies.
  if (bereq.url ~ "^[^?]*\.(7z|avi|bmp|bz2|css|csv|doc|docx|eot|flac|flv|gif|gz|ico|jpeg|jpg|js|less|mka|mkv|mov|mp3|mp4|mpeg|mpg|odt|otf|ogg|ogm|opus|pdf|png|ppt|pptx|rar|rtf|svg|svgz|swf|tar|tbz|tgz|ttf|txt|txz|wav|webm|webp|woff|woff2|xls|xlsx|xml|xz|zip)(\?.*)?$") {
    unset beresp.http.set-cookie;
  }

  # Large static files are delivered directly to the end-user without
  # waiting for Varnish to fully read the file first.
  # Varnish 4 fully supports Streaming, so use streaming here to avoid locking.
  if (bereq.url ~ "^[^?]*\.(7z|avi|bz2|flac|flv|gz|mka|mkv|mov|mp3|mp4|mpeg|mpg|ogg|ogm|opus|rar|tar|tgz|tbz|txz|wav|webm|xz|zip|csv)(\?.*)?$") {
    unset beresp.http.set-cookie;
    set beresp.do_stream = true;  # Check memory usage it'll grow in fetch_chunksize blocks (128k by default) if the backend doesn't send a Content-Length header, so only enable it for big objects
    set beresp.do_gzip   = false;   # Don't try to compress it for storage
  }

  # Set ban-lurker friendly custom headers
  set beresp.http.X-Url = bereq.url;
  set beresp.http.X-Host = bereq.http.host;

  # Allow items to be stale if needed.
  set beresp.grace = 1h;
}

sub vcl_deliver {
    # These headers are for internal use (or debugging) only
    unset resp.http.X-Url;
    unset resp.http.X-Host;
    unset resp.http.X-Upstream;
    unset resp.http.Cache-Tags;
    unset resp.http.X-Drupal-Cache;
    unset resp.http.X-Drupal-Dynamic-Cache;

    if (obj.hits > 0) {
            set resp.http.X-Edge-Cache = "HIT";
    } else {
            set resp.http.X-Edge-Cache = "MISS";
    }
}

sub vcl_purge {
    return (synth(200, "Purged"));
}
