# 🐦 Birdbord — Project & Task Collaboration Platform

**Birdbord** is a simple and elegant project management application built using **Laravel**, **Blade**, **Tailwind CSS**, and **Alpine.js**. It allows users to manage projects, track tasks, collaborate with team members, and view a live activity feed for each project — all within a clean and intuitive interface.

---

## ✨ Features

- ✅ Create and manage **projects**
- 📝 Add and update **tasks** within projects
- 🧑‍🤝‍🧑 **Invite collaborators** to work on shared projects
- 🔔 View a real-time **activity log** to track changes and updates
- 🔒 Built with **Laravel authentication** for secure access
- ⚡ Fully responsive UI using **Tailwind CSS** and **Alpine.js**

---

## 🔧 Tech Stack

| Layer         | Technology             |
|---------------|------------------------|
| Backend       | Laravel                |
| Frontend      | Blade + Alpine.js      |
| Styling       | Tailwind CSS           |
| Database      | MySQL / SQLite         |
| Auth          | Laravel Breeze / Jetstream *(optional)*

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/birdbord.git
cd birdbord
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run dev
```
### 3. Set Up the Environment
```bash
cp .env.example .env
php artisan key:generate
```
Configure your .env file with your database credentials.

### 4. Run Migrations
```bash
php artisan migrate
```
### 5. Start the Application
```bash    
php artisan serve
```
Visit http://localhost:8000

🤝 Collaboration & Authorization

- Project owners can invite users by email to join their project.
- Only authorized users can view or edit project tasks.
- Activities like task updates, user invitations, and completions are logged in the activity panel.

🔍 Project Structure Highlights
    
- app/Models/Project.php – Project model with task and invitation relationships    

- app/Models/Task.php – Task model with ownership and completion logic
    
- resources/views/projects/ – Blade views for project dashboard

- app/Policies/ – Authorization logic to protect project actions

- resources/js/ – Alpine.js interactivity (toggle activity feeds, modals, etc.)

📖 Inspired By

This project is inspired by real-world team collaboration needs and the Laravel ecosystem’s best practices. The name "Birdbord" is a play on "birdboard" — a nod to light, agile teamwork and transparency.

🛡 Security

If you discover a vulnerability, please open an issue or reach out privately.

📄 License

© 2025 Abderrahim El Ouariachi. All rights reserved. 

🙌 Credits

Crafted with ❤️ using Laravel, Blade, Tailwind CSS, and Alpine.js.


