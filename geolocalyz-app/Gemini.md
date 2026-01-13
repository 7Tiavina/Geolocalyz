# 🚀 Geolocalyz — Gemini.md  
## MVP Architecture & APIs (Laravel)

Ce document décrit **l’architecture technique**, les **APIs utilisées** et la **mise en place du MVP** de **Geolocalyz**, en s’appuyant **strictement sur les vues existantes** et **sans modifier les designs**.

Objectif :  
👉 rendre le site **dynamique**,  
👉 intégrer la **géolocalisation avec consentement**,  
👉 stocker et afficher les données localement,  
👉 **sans envoi par email/SMS pour le MVP**.

---

## 🎯 Objectif du MVP

- Utiliser les vues existantes
- Générer une demande de géolocalisation
- Récupérer :
  - position GPS
  - adresse complète
  - informations IP
- Afficher la localisation sur une carte
- Accéder aux données via un dashboard
- Suppression automatique (plus tard)

---

## 🧭 Parcours utilisateur (basé sur les routes existantes)

### 1. Home  
`/`

Landing page statique

---

### 2. Ajout numéro  
`/add-number`

- Saisie numéro (ou identifiant)
- Création d’une **LocationRequest**
- Génération d’un **UUID sécurisé**
- Redirection vers `/search-number`

---

### 3. Page de géolocalisation  
`/search-number`

- Page de consentement
- Bouton **“Autoriser la localisation”**
- Appel **HTML5 Geolocation API**
- Envoi des données vers Laravel (AJAX)

---

### 4. Ajout email (optionnel MVP)
`/add-email`

- Stockage simple (optionnel)
- Pas d’envoi pour l’instant

---

### 5. Accès Dashboard  
`/access-Dashboard`

- Liste des demandes
- Dernière position reçue
- Lien vers carte

---

### 6. Carte & détails  
`/access-Localisation`

- Carte Leaflet
- Marqueur position
- Infos adresse + IP

---

## 🧠 APIs utilisées (100 % gratuites)

### 📍 Géolocalisation GPS
**HTML5 Geolocation API (navigateur)**  
- Gratuit
- Sans clé
- Consentement obligatoire

Utilisée dans :
- `/search-number`

---

### 🗺️ Reverse Geocoding (adresse)
**Nominatim – OpenStreetMap**

- Utilisée côté **backend Laravel**
- PHP natif / Http Client
- Cache obligatoire (plus tard)

Données récupérées :
- pays
- région
- ville
- quartier
- rue
- code postal
- adresse complète

---

### 📡 IP Geolocation (complément)
**ipapi.co (free tier)**

- Pays
- Ville
- ASN
- Opérateur réseau (approximatif)

Utilisée comme **fallback / enrichissement**

---

### 🗺️ Carte
**Leaflet.js + OpenStreetMap**

- Gratuit
- Open-source
- Aucun token

---

## 🧱 Architecture Laravel (MVP)

