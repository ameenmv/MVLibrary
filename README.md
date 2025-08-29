# MVLib - Online Library Management System

A comprehensive full-stack web application for managing library operations with separate interfaces for students and administrators. Built with modern technologies including Vue.js 3 and Laravel 12.

## ✨ Features

### Student Module
- **User Registration & Login**: Secure account creation with student ID, name, email, and password
- **Book Browsing**: Comprehensive book catalog with search and category filtering
- **Book Borrowing**: Intuitive borrowing system with automatic 14-day return date calculation
- **Personal Dashboard**: Centralized view of borrowed books, return dates, and borrowing history
- **Book Returns**: Simple book return process
- **Profile Management**: Update personal information and change passwords

### Admin Module
- **Admin Dashboard**: Comprehensive overview with library statistics and analytics
- **Book Management**: Full CRUD operations for books (add, edit, delete) with detailed information
- **User Management**: Search and view student details by student ID
- **Borrowing Records**: Monitor all book borrowing activities across the library
- **Statistics**: Real-time view of total books, borrowed books, available books, and user counts

### Technical Features
- **Responsive Design**: Fully responsive interface that works on all devices
- **Role-Based Access Control**: Secure separation between student and admin functionalities
- **Form Validation**: Comprehensive client-side validation using Vuelidate
- **Real-time Updates**: Dynamic content updates without page refresh
- **Cross-browser Compatibility**: Works seamlessly across all modern browsers

## 🛠️ Tech Stack

### Frontend
- **Framework**: Vue.js 3 with Composition API
- **Styling**: Tailwind CSS 4.1 with custom CSS variables
- **Routing**: Vue Router 4
- **State Management**: Pinia 3
- **Validation**: Vuelidate 2
- **HTTP Client**: Axios
- **Build Tool**: Vite 7
- **CSS Preprocessor**: Sass

### Backend
- **Framework**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL/PostgreSQL with Eloquent ORM
- **Authentication**: Laravel Sanctum
- **Testing**: Pest PHP with Laravel testing utilities
- **Development Tools**: Laravel Sail, Laravel Pail
- **Code Quality**: Laravel Pint, Laravel Breeze

### Development Tools
- **Package Manager**: Composer (PHP), npm (Node.js)
- **Version Control**: Git
- **Code Quality**: ESLint, Prettier (configurable)

## 🚀 Installation Guide

### Prerequisites
- **PHP**: 8.2 or higher
- **Node.js**: 18 or higher
- **Composer**: Latest version
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **Web Server**: Apache/Nginx (or use Laravel's built-in server)

### Step 1: Clone the Repository
```bash
git clone <your-repository-url>
cd project
```

### Step 2: Backend Setup
```bash
cd back

# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=mvlib
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Run database migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed

# Install Node.js dependencies
npm install
```

### Step 3: Frontend Setup
```bash
cd ../front

# Install Node.js dependencies
npm install
```

### Step 4: Environment Configuration
Create a `.env` file in the frontend directory:
```bash
cd ../front
cp .env.example .env
# Configure your backend API URL
VITE_API_URL=http://localhost:8000/api
```

### Step 5: Start Development Servers

**Terminal 1 - Backend:**
```bash
cd back
php artisan serve
# Server will run on http://localhost:8000
```

**Terminal 2 - Frontend:**
```bash
cd front
npm run dev
# Server will run on http://localhost:5173
```

### Step 6: Access the Application
- **Frontend**: http://localhost:5173
- **Backend API**: http://localhost:8000/api

## 📖 Usage

### Student Registration & Access
1. Navigate to the registration page
2. Fill in your details (Name, Student ID, Email, Password)
3. Leave the Admin Code field empty
4. Login and access your personalized dashboard
5. Browse and borrow books with a 14-day loan period
6. Return books through your dashboard

### Admin Access
1. Navigate to the registration page
2. Fill in your details
3. Enter `ADMIN2024` in the Admin Code field
4. Access the comprehensive admin dashboard
5. Manage books, users, and monitor library operations

### Key Features
- **Book Search**: Use the search bar to find specific books
- **Category Filtering**: Filter books by genre or subject
- **Borrowing History**: Track all your borrowing activities
- **Profile Updates**: Keep your information current
- **Real-time Statistics**: Admins can monitor library usage

## 🔮 Future Improvements

### Phase 1: Enhanced Features
- [ ] **Advanced Search**: Full-text search with filters and sorting
- [ ] **Email Notifications**: Automated reminders for due dates
- [ ] **Book Reviews**: Student rating and review system
- [ ] **Reservation System**: Book reservation for unavailable titles

### Phase 2: Technical Enhancements
- [ ] **Real-time Updates**: WebSocket integration for live notifications
- [ ] **Mobile App**: React Native or Flutter mobile application
- [ ] **API Documentation**: Comprehensive API documentation with Swagger
- [ ] **Performance Optimization**: Caching and database optimization

### Phase 3: Advanced Capabilities
- [ ] **Multi-language Support**: Internationalization (i18n)
- [ ] **Advanced Analytics**: Detailed usage reports and insights
- [ ] **Integration APIs**: Connect with external library systems
- [ ] **Cloud Deployment**: Docker containerization and cloud hosting

## 🤝 Contributing

We welcome contributions to improve MVLib! Here's how you can help:

### Getting Started
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Test thoroughly
5. Commit your changes (`git commit -m 'Add amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

### Development Guidelines
- Follow the existing code style and conventions
- Write clear commit messages
- Include tests for new features
- Update documentation as needed
- Ensure cross-browser compatibility

### Areas for Contribution
- **Frontend**: UI/UX improvements, new components, accessibility
- **Backend**: API enhancements, database optimization, security
- **Documentation**: Code comments, API docs, user guides
- **Testing**: Unit tests, integration tests, end-to-end tests

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2024 MVLib

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

**⭐ Star this repository if you find it helpful!**

*Built with ❤️ by the MVLib Development Team*
