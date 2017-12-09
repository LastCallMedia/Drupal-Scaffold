Setting your Pantheon Machine Token
===================================
This project uses Pantheon's API to fetch copies of the database for local development. To use the API, you need to create a "machine token" that identifies you. We recommend setting your machine token globally as an environment variable using the following steps:

- [ ] Create a machine token in Pantheon by following [these steps](https://pantheon.io/docs/machine-tokens/).
- [ ] On your local machine, edit or create the `.bash_profile` file in your home directory.  Add the following line:
    ```bash
    export TERMINUS_MACHINE_TOKEN="PASTE YOUR TOKEN HERE"
    ```
- [ ] Open a new terminal window and test that your machine token is properly set by running the following command:
    ```bash
    [ -z "$TERMINUS_MACHINE_TOKEN" ] && echo "All good" || echo "Token not set"
    # Should output "All good"
    ```
