# Online Library Management System

A comprehensive web application for managing library operations with separate interfaces for students and administrators.

## Features

### Student Module
- **User Registration & Login**: Students can create accounts with student ID, name, email, and password
- **Book Browsing**: View all available books with search and category filtering
- **Book Borrowing**: Borrow books with automatic return date calculation (14 days)
- **Personal Dashboard**: View borrowed books, return dates, and borrowing history
- **Book Returns**: Return borrowed books to the library
- **Profile Management**: Update personal information and change passwords

### Admin Module
- **Admin Dashboard**: Comprehensive overview of library statistics
- **Book Management**: Add, edit, and delete books with detailed information
- **User Management**: Search and view student details by student ID
- **Borrowing Records**: Monitor all book borrowing activities
- **Statistics**: View total books, borrowed books, available books, and user counts

## Technical Stack

- **Frontend**: Vue.js 3 with Composition API
- **Styling**: Tailwind CSS with custom CSS variables
- **Routing**: Vue Router 4
- **Validation**: Vuelidate for form validation
- **HTTP Client**: Axios for API calls
- **Build Tool**: Vite

## Project Structure

```
src/
├── components/
│   └── Navbar.vue          # Navigation component with role-based display
├── Pages/
│   ├── Home.vue            # Landing page
│   ├── Login.vue           # User authentication
│   ├── Register.vue        # User registration (students & admins)
│   ├── Dashboard.vue       # Student dashboard
│   ├── AdminDashboard.vue  # Admin dashboard
│   └── Profile.vue         # User profile management
├── Router/
│   └── index.js            # Route configuration
├── assets/                 # Static assets (videos, images)
├── style.css              # Global styles and CSS variables
└── main.js                # Application entry point
```

## Getting Started

### Prerequisites
- Node.js (version 14 or higher)
- npm or yarn

### Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd front
```

2. Install dependencies:
```bash
npm install
```

3. Start the development server:
```bash
npm run dev
```

4. Open your browser and navigate to `http://localhost:5173`

### Building for Production

```bash
npm run build
```

## Usage

### Student Registration
1. Navigate to `/Register`
2. Fill in your details (Name, Student ID, Email, Password)
3. Leave the Admin Code field empty for student registration
4. Submit the form

### Admin Registration
1. Navigate to `/Register`
2. Fill in your details
3. Enter `ADMIN2024` in the Admin Code field
4. Submit the form

### Student Features
- Login and access your dashboard
- Browse available books
- Borrow books (14-day loan period)
- Return books
- Update your profile

### Admin Features
- Login with admin credentials
- Access admin dashboard
- Manage books (add, edit, delete)
- Search and view student information
- Monitor borrowing records

## API Integration

The application is currently configured to work with a mock API endpoint. In a production environment, you would need to:

1. Update the API endpoints in the components
2. Implement proper authentication and authorization
3. Add error handling for API failures
4. Implement real-time updates

## Security Features

- Form validation using Vuelidate
- Role-based access control
- Session management using localStorage
- Password confirmation validation
- Input sanitization

## Responsive Design

The application is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile devices

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT License.

## Support

For support and questions, please contact the development team.

---

**Note**: This is a frontend-only implementation. For a production system, you would need to implement a backend API and database to handle data persistence and business logic.
"# MVLib" 
"# MVLib" 
