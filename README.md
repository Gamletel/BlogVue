# Blog (Laravel + Vue + Docker)


---

## 📋 Содержание

- [Функционал](#-a-hrefфункционалфункционалa)
- [Установка](#-a-hrefустановкаустановкаa)
- [Технологии](#-технологии)
- [Docker Сервисы](#-docker-сервисы)
- [API Документация](#-api-документация)
---

## ⚙️ Функционал

- **Аутентификация:**
    - Регистрация с отправкой welcome email.
    - Логин, выход и обновление профиля.
- **Работа с постами:**
    - CRUD операций.
    - Комментарии к постам.
- **Интеграция API:**
    - Swagger-документация.
- **Redis** для повышения использования системы очередей и кеширования.
---

## 🚀 Установка

### 1. Клонирование репозитория

```bash
git clone https://github.com/Gamletel/BlogVue.git
cd BlogVue
```

### 2. Установка зависимостей
#### Backend
```bash
composer install
```

#### Frontend
```bash
cd frontend
npm install
```

### 3. Скопируйте env
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Запуск Docker
#### Соберите и запустите контейнеры:
```bash
docker-compose up --build
```
---

## 🛠️ Технологии

- Backend: Laravel 11.x
- Frontend: Vue 3 + Vite
- База данных: PostgreSQL (через Docker)
- Кеширование: Redis (через докер)
- Веб-сервер: Nginx (через Docker)
- Окружение: Docker + Docker Compose
- Пакеты:
- Аутентификация: Laravel Sanctum
- Документация API: Swagger (L5 Swagger)
- Отправка email: Mailtrap

---

## 🐳 Docker Сервисы

Проект состоит из следующих контейнеров:
* PHP 8.2 FPM
  + Основной backend.
  + Расширения: pdo_pgsql, gd, redis, xdebug.
* PostgreSQL
    + Настройки:
      - Пользователь: blog_vue.
      - Пароль: blog_vue.
      - База данных: blog_vue.
*	Redis
  + Для кеширования и использования системы очередей. 
* Nginx
  + Обрабатывает веб-запросы.
  + Проксирует запросы на PHP-FPM.

---

## 📚 API Документация
### Swagger-документация доступна по пути:

[http://localhost:8080/api/documentation](http://localhost:8080/api/documentation)

---
