# How to Enable GD Extension in PHP

The error "Unable to generate image: please check if the GD extension is enabled and configured correctly" occurs because the PHP GD extension is not enabled.

## Steps to Enable GD Extension:

### 1. Locate your php.ini file
Run this command to find your PHP configuration file:
```bash
php --ini
```

### 2. Edit php.ini file
Open the php.ini file in a text editor (as Administrator/with sudo if needed)

### 3. Find and uncomment the GD extension line
Look for this line:
```ini
;extension=gd
```

Remove the semicolon (`;`) at the beginning to enable it:
```ini
extension=gd
```

### 4. Save the file and restart your web server
- If using Apache: restart Apache service
- If using `php spark serve`: Stop the current server (Ctrl+C) and start it again

### 5. Verify GD is enabled
Run this command to check:
```bash
php -m | grep -i gd
```

You should see "gd" in the output.

## Alternative: Check if extension file exists

If the extension line is uncommented but still not working, check if the extension file exists:

**For Windows:**
- Look in your PHP installation directory under `ext` folder
- File should be named `php_gd.dll` or `php_gd2.dll`

**For Linux/Mac:**
- Install GD extension using package manager:
  ```bash
  # Ubuntu/Debian
  sudo apt-get install php-gd
  
  # CentOS/RHEL
  sudo yum install php-gd
  
  # MacOS (using Homebrew)
  brew install php@8.2
  ```

After installing, restart your web server.

## After Enabling GD

Once GD is enabled, the QR code download feature should work properly!
