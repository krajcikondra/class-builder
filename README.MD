# Class builder

## Usage in command prompt
```sh
php C:\pathToClassBuilderLibrary\createControl.php %cd% App\Forms MyForm firstname,lastname
del MyForm.bat
```

## Usage in PHPStorm

### Options

inputs options
* basic usage `` firstname ``
* required `` firstname* ``
* define label `` firstname:Enter your firstname ``

Examples:
`` php createControl.php %cd% App\Forms MyForm firstname*:Yout Firstname,lastname* ``