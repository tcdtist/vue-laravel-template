# Monorepo Todo App

A Todo List application built with Laravel (Backend) and Vue.js 3 (Frontend) in a monorepo structure.

## Technologies Used

### Backend

- Laravel 10.x
- PHP 8.1+
- MySQL 8.0
- Laravel Sanctum (Authentication)
- PHPUnit (Testing)

### Frontend

- Vue.js 3
- Vite
- Tailwind CSS
- Axios
- ESLint + Prettier
- Husky + lint-staged
- Commitlint

## System Requirements

- PHP >= 8.1
- Composer
- Node.js >= 16
- npm or yarn
- MySQL >= 8.0
- Git

## Directory Structure

my-monorepo/
│── backend/ # Laravel backend
│── frontend/ # Vue.js frontend
├── packages/ # Shared packages
├── .github/ # GitHub Actions workflows
├── docker/ # Docker configuration
└── README.md

## Installation

1. Clone the repository:

```bash
git clone <repository-url>
cd my-monorepo
```

2. Install Backend dependencies:

```bash
   cd /backend
   composer install
   cp .env.example .env
   php artisan key:generate
```

3. Configure database in .env file:

```bash
   env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=monorepo_demo
   DB_USERNAME=root
   DB_PASSWORD=
```

4. Run migrations:

```bash
   php artisan migrate
```

5. Install Frontend dependencies:

```bash
   cd ../frontend
   npm install
```

## Development

1. Run Backend server:

```bash
   cd /backend
   php artisan serve
```

Backend will run at http://localhost:8000

2. Run Frontend development server:

```bash
   cd /frontend
   npm run dev
```

Frontend will run at http://localhost:5173

## Testing

### Backend Tests

```bash
cd /backend
php artisan test
```

### Frontend Linting

```bash
cd /frontend
npm run lint
```

## API Endpoints

### Todos

- GET `/api/todos` - Get all todos
- POST `/api/todos` - Create new todo
- PUT `/api/todos/{id}` - Update todo
- DELETE `/api/todos/{id}` - Delete todo

## API Request Examples

### Create Todo

```bash
curl -X POST http://localhost:8000/api/todos \
 -H "Content-Type: application/json" \
 -d '{"title": "New Todo", "completed": false}'
```

### Update Todo

```bash
curl -X PUT http://localhost:8000/api/todos/1 \
 -H "Content-Type: application/json" \
 -d '{"completed": true}'
```

## Commit Convention

This project uses conventional commits. Types include:

- feat: New feature
- fix: Bug fix
- docs: Documentation changes
- style: Changes that don't affect code
- refactor: Code refactoring
- test: Adding or fixing tests
- chore: Changes to build process or auxiliary tools

## CI/CD

The project uses GitHub Actions for CI/CD:

- CI pipeline runs on push or pull request to main branch
- Checks coding standards
- Runs tests
- Automatic build and deploy when merged to main

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'feat: add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

MIT License - see [LICENSE.md](LICENSE.md) for details

## Contact

Your Name - [your-email@example.com](mailto:your-email@example.com)

Project Link: [https://github.com/username/my-monorepo](https://github.com/username/my-monorepo)

## Acknowledgments

- [Laravel](https://laravel.com)
- [Vue.js](https://vuejs.org)
- [Tailwind CSS](https://tailwindcss.com)
- [Vite](https://vitejs.dev)
