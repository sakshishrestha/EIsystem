# EISystem - Expense and Income Management System 
## Expense and Income Management System calculates the expenses and income on the basis of: 
## 1. Year 
## 2. Month 
## 3. Week 
## 4. Day

## Step-1 Run the Project Command
# php artisan serve

## Step-2 Register your User and Login 
# http://127.0.0.1:8000/register
# http://127.0.0.1:8000/login
 
## Step-3 Run the Factory Command 
# php artisan tinker 
# User::factory()->count(5)->create();
# php artisan tinker 
# Expense::factory()->count(5)->create();
# php artisan tinker 
# Income::factory()->count(5)->create();

## Step -4 Login to Back Office and Create and Manage the Expense
# http://127.0.0.1:8000/expenses/create
# http://127.0.0.1:8000/expenses

## Step -4 Login to Back Office and Create and Manage the Income
# http://127.0.0.1:8000/income/create
# http://127.0.0.1:8000/income

## Step -4 Login to Back Office and Manage the Reports
# http://127.0.0.1:8000/reports/index
