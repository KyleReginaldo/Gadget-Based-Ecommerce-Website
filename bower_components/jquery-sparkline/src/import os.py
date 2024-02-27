import os
import PyInstaller.__main__

def get_path():
    while True:
        path = input("Enter the path of the file or folder: ")
        if os.path.exists(path):
            return path
        else:
            print("Invalid path. Please try again.")

def create_installer(source_path):
    spec_file = f"installer_spec.spec"

    with open(spec_file, "w") as spec:
        spec.write(f'''
# -*- mode: python ; coding: utf-8 -*-

block_cipher = None

a = Analysis(['{source_path}'],
             pathex=['{os.path.dirname(__file__)}'],
             binaries=[],
             datas=[],
             hiddenimports=[],
             hookspath=[],
             runtime_hooks=[],
             excludes=[],
             win_no_prefer_redirects=False,
             win_private_assemblies=False,
             cipher=block_cipher,
             noarchive=False)
pyz = PYZ(a.pure, a.zipped_data,
             cipher=block_cipher)
exe = EXE(pyz,
          a.scripts,
          [],
          exclude_binaries=True,
          name='installer',
          debug=False,
          bootloader_ignore_signals=False,
          bootloader_initializers=[],
          strip=False,
          upx=True,
          upx_exclude=[],
          runtime_tmpdir=None,
          console=True )
''')

    # Create the installer using PyInstaller
    PyInstaller.__main__.run([
        'installer_spec.spec',
        '--onefile',
        '--clean'
    ])

    # Clean up the spec file
    os.remove(spec_file)

if __name__ == "__main__":
    source_path = get_path()
    create_installer(source_path)

    print(f"Installer created successfully. Output file: {os.path.join(os.getcwd(), 'dist', 'installer.exe')}")
