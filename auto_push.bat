@echo off
setlocal enabledelayedexpansion

echo ===================================================
echo   StitchSmart - Automatic Git Backup
echo ===================================================
echo.

:: Check git status
echo Checking repository status...
git status --short
echo.

:: Ask for commit message or use default
set /p commit_msg="Enter commit message (Press Enter for 'Auto-backup: %DATE% %TIME%'): "
if "!commit_msg!"=="" (
    set commit_msg=Auto-backup: %DATE% %TIME%
)

echo.
echo Staging changes...
git add -A

echo.
echo Committing changes...
git commit -m "!commit_msg!"

echo.
echo Pushing to backup repository (StitchSmartbackup)...
:: Disable prompts and helper to ensure token in URL is used
set GIT_TERMINAL_PROMPT=0
set GCM_INTERACTIVE=never
git -c credential.helper= -c core.askPass= push backup main

if %ERRORLEVEL% equ 0 (
    echo.
    echo ===================================================
    echo   Backup Successful!
    echo ===================================================
) else (
    echo.
    echo ===================================================
    echo   Backup Failed!
    echo ===================================================
)

echo.
pause
