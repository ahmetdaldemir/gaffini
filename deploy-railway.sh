#!/bin/bash

echo "🚂 Railway Deployment Script"
echo "=============================="

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo "❌ Git is not installed. Please install git first."
    exit 1
fi

# Check if we're in a git repository
if ! git rev-parse --git-dir > /dev/null 2>&1; then
    echo "❌ This is not a git repository. Please run this script from your project root."
    exit 1
fi

# Check current branch
CURRENT_BRANCH=$(git branch --show-current)
echo "📍 Current branch: $CURRENT_BRANCH"

# Check if there are uncommitted changes
if ! git diff-index --quiet HEAD --; then
    echo "⚠️  Warning: You have uncommitted changes."
    read -p "Do you want to continue? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "❌ Deployment cancelled."
        exit 1
    fi
fi

# Check if remote origin exists
if ! git remote get-url origin &> /dev/null; then
    echo "❌ No remote origin found. Please add your Railway git remote first."
    echo "Example: git remote add origin https://railway.app/git/your-project-id"
    exit 1
fi

# Show remote URL
REMOTE_URL=$(git remote get-url origin)
echo "🔗 Remote URL: $REMOTE_URL"

# Check if this is a Railway remote
if [[ $REMOTE_URL == *"railway.app"* ]]; then
    echo "✅ Railway remote detected!"
else
    echo "⚠️  Warning: This doesn't look like a Railway remote."
    read -p "Continue anyway? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "❌ Deployment cancelled."
        exit 1
    fi
fi

# Deploy to Railway
echo "🚀 Deploying to Railway..."
echo "This may take several minutes..."

# Push to Railway
if git push origin $CURRENT_BRANCH; then
    echo "✅ Deployment successful!"
    echo ""
    echo "📋 Next steps:"
    echo "1. Go to Railway Dashboard: https://railway.app/dashboard"
    echo "2. Check your deployment logs"
    echo "3. Wait for the build to complete"
    echo "4. Test your endpoints:"
    echo "   - Health check: https://your-app.railway.app/health"
    echo "   - Database test: https://your-app.railway.app/db-test"
    echo ""
    echo "🎉 Your app should be live soon!"
else
    echo "❌ Deployment failed!"
    echo "Check the error messages above and try again."
    exit 1
fi
