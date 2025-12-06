# 🟢⚪ Geolocalyz🍋‍🟩 — SaaS de géolocalisation 🟢⚪

**Geolocalyz** est un **SaaS Laravel** simple, moderne et éthique permettant de demander et recevoir la localisation d’une personne via un lien unique et sécurisé — uniquement avec son **consentement explicite**.

---

## 🚀 Fonctionnalités principales

* Envoi d’un lien de géolocalisation (SMS, WhatsApp ou copie simple)
* Page de consentement + autorisation GPS HTML5
* Récupération de la position : latitude, longitude, précision, timestamp
* Affichage en temps réel dans un dashboard Laravel
* Expiration automatique des demandes
* Suppression sécurisée des données
* Interface simple, minimaliste, responsive

---

## 🛠️ Stack Technique

### **Backend : Laravel 11**

* API Resources
* Jobs / Queues
* Notifications
* Middleware sécurité
* Laravel Breeze / Fortify pour l’auth
* Policies + Gate pour permissions

### **Frontend : Blade + Alpine.js**

* UI minimaliste inspirée Tailwind
* Cartes intégrées (Leaflet.js – gratuit)

---

## 🧰 Outils gratuits et simples à intégrer

### **📍 Géolocalisation**

* **HTML5 Geolocation API** *(gratuit, natif, aucune config)*

### **🗺️ Cartographie**

* **Leaflet.js** *(open-source, rapide, parfait pour un SaaS)*
* Fond de carte gratuit : **OpenStreetMap**

### **📨 Envoi de SMS / WhatsApp (alternatives gratuites)**

> Les SMS ne sont jamais 100% gratuits, mais voici les services avec essais gratuits simples :

* **Twilio Free Trial**
* **Vonage Free Credit**
* **MessageBird Trial**

### **📦 Storage / Logs / Monitoring**

* Laravel Log Viewer (gratuit)
* Laravel Telescope (debug avancé)

### **🔐 Sécurité & RGPD**

* Cryptage natif Laravel
* Expiration automatique via Scheduler
* Suppression des données via Jobs

## ⚙️ Workflow de géolocalisation

1. L’utilisateur crée une demande → numéro, message, expiration
2. Laravel génère un lien unique (UUID)
3. Le lien est envoyé (SMS / WhatsApp)
4. Le destinataire ouvre la page → accepte le consentement
5. La position GPS est envoyée à l’API Laravel
6. Dashboard mis à jour en direct
7. Données supprimées automatiquement après expiration

---


## ❤️ À propos

Geolocalyz est un SaaS pensé pour la **simplicité**, la **sécurité**, et le **respect total de la vie privée**.
