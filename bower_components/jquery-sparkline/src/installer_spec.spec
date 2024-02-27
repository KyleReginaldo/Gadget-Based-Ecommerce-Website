
# -*- mode: python ; coding: utf-8 -*-

block_cipher = None

a = Analysis(['E:\Assignment'],
             pathex=['E:\Xamnp\htdocs\ecomm\bower_components\jquery-sparkline\src'],
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
