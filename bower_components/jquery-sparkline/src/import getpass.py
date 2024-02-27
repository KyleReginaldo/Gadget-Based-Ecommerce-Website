import os
import getpass

def get_file_path():
    while True:
        file_path = input("Enter the path of the file: ")
        if os.path.exists(file_path) and os.path.isfile(file_path):
            return file_path
        else:
            print("Invalid file path. Please try again.")

def get_password():
    while True:
        password = getpass.getpass("Enter a password: ")
        if password:
            return password
        else:
            print("Password cannot be empty. Please try again.")

def convert_to_binary(file_path, password):
    try:
        with open(file_path, 'rb') as file:
            content = file.read()

        # Simple encryption (you can implement a more secure algorithm if needed)
        encrypted_content = content + bytes(password, 'utf-8')

        # Write encrypted content to binary file
        output_path = 'output.bin'
        with open(output_path, 'wb') as binary_file:
            binary_file.write(encrypted_content)

        print(f"File successfully converted to binary. Output file: {output_path}")

    except PermissionError as e:
        print(f"PermissionError: {e}")
        print("Ensure that the script has the necessary permissions to read the file.")
    except Exception as e:
        print(f"An error occurred: {e}")

if __name__ == "__main__":
    file_path = get_file_path()
    password = get_password()
    convert_to_binary(file_path, password)
