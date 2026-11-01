# Database

users: id, name, email, password, role, timestamps

settings: id, group, key, value (text/json), type (text|color|image|bool|json), timestamps; unique(group,key)

categories: id, parent_id nullable, name, slug unique, description, sort_order, is_active, seo_title, seo_description, timestamps, deleted_at
  (image via media library)

products: id, category_id FK, name, slug unique, short_description, description (long), specs json (key/value rows), is_featured, is_active, sort_order, seo_title, seo_description, timestamps, deleted_at
  (featured image + gallery via media library)

media: managed by spatie/laravel-medialibrary

contact_messages: id, name, email, phone, subject, message, status (new|read|replied), ip, user_agent, read_at, timestamps

quote_requests: id, name, company, email, phone, country, product_id nullable FK, product_name (snapshot), quantity, unit, message, status (new|reviewing|quoted|closed), ip, user_agent, timestamps

Indexes: slugs, is_active+sort_order, status+created_at on submissions.
Rule: deleting a product must not break old quote requests (use product_name snapshot, nullOnDelete).
