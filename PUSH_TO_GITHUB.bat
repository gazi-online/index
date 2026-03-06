@echo off
title Gazi Online - Push to GitHub
cd /d "%~dp0"

echo ========================================
echo  Gazi Online - GitHub Pages Deploy
echo ========================================
echo.

set GIT="C:\Program Files\Git\cmd\git.exe"

echo [1/5] Setting up git identity...
%GIT% config --global user.email "gazi-online@github.com"
%GIT% config --global user.name "Gazi Online"

echo [2/5] Initializing git repository...
%GIT% init
%GIT% branch -M main

echo [3/5] Adding all files...
%GIT% add .

echo [4/5] Creating commit...
%GIT% commit -m "Initial commit - Gazi Online website"

echo [5/5] Pushing to GitHub...
echo.
echo  A browser window will open asking you to sign in to GitHub.
echo  Please sign in and allow access when prompted.
echo.
%GIT% remote remove origin 2>nul
%GIT% remote add origin https://github.com/gazi-online/index.git
%GIT% push -u origin main

echo.
echo ========================================
if %ERRORLEVEL% EQU 0 (
    echo  SUCCESS! Your site is being deployed!
    echo  Visit: https://gazi-online.github.io/index/
    echo  (Wait 2-3 minutes for GitHub Actions to finish)
) else (
    echo  ERROR: Push failed. Check the error above.
)
echo ========================================
echo.
pause
