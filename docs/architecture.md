# Architettura del Progetto Laravel Pizza

## Struttura Modulare

L'applicazione Laravel Pizza utilizza un'architettura modulare basata sul pacchetto `nwidart/laravel-modules`. Questa struttura consente una separazione chiara delle funzionalità e facilita la manutenzione e lo sviluppo scalabile.

## Moduli del Sistema

### Xot (Core Utilities)
- **Funzione**: Modulo base che fornisce funzionalità comuni
- **Componenti principali**:
  - GetViewAction: Risoluzione dinamica delle viste
  - ThemeComposer: Composizione dei temi
  - Actions: Azioni riutilizzabili per la business logic
- **Dipendenze**: Utilizzato da tutti gli altri moduli

### UI (Interfaccia Utente)
- **Funzione**: Componenti e layout riutilizzabili
- **Componenti principali**:
  - Componenti Blade personalizzati
  - Layout di base
  - Componenti UI ricorrenti
- **Relazioni**: Utilizzato da tutti i moduli che forniscono UI

### User (Autenticazione e Autorizzazione)
- **Funzione**: Gestione utenti, autenticazione e permessi
- **Componenti principali**:
  - Modello User con Laravel Fortify
  - Ruoli e permessi con Laravel Permission
  - Due-factor authentication
- **Relazioni**: Fondamentale per tutti i moduli che richiedono autenticazione

### Cms (Content Management System)
- **Funzione**: Gestione contenuti dinamici
- **Componenti principali**:
  - Blocchi di contenuto dinamici
  - Gestione pagine
  - Editor visivi
- **Relazioni**: Interagisce con UI per rendering e Xot per azioni

### Tenant (Multi-tenancy)
- **Funzione**: Supporto per più sedi/franchise
- **Componenti principali**:
  - Gestione tenant
  - Isolamento dati per tenant
  - Configurazioni specifiche per tenant
- **Relazioni**: Integra con tutti i moduli per isolamento dati

### Activity (Logging)
- **Funzione**: Tracciamento delle attività
- **Componenti principali**:
  - Log delle azioni utente
  - Auditing
  - Cronologia eventi
- **Relazioni**: Utilizzato da tutti i moduli per logging

### Media (Gestione File)
- **Funzione**: Gestione file multimediali
- **Componenti principali**:
  - Upload e gestione immagini
  - Conversione formati
  - Ottimizzazione
- **Relazioni**: Utilizzato da Cms, UI e altri moduli con contenuti multimediali

### Notify (Notifiche)
- **Funzione**: Sistema di notifiche
- **Componenti principali**:
  - Notifiche in-app
  - Email
  - SMS
- **Relazioni**: Utilizzato da tutti i moduli per comunicazioni utente

### Geo (Geolocalizzazione)
- **Funzione**: Servizi geografici
- **Componenti principali**:
  - Geocoding
  - Calcolo distanze
  - Zone di consegna
- **Relazioni**: Utilizzato da ordini e consegne

### Seo (Ottimizzazione)
- **Funzione**: Ottimizzazione per motori di ricerca
- **Componenti principali**:
  - Meta tags
  - Schema markup
  - Sitemap
- **Relazioni**: Integra con Cms e pagine pubbliche

## Flusso Richieste (Frontoffice)

```
Richiesta HTTP
    ↓
Laravel Folio (routing file-based automatico)
    ↓
Blade Page (resources/views/pages/*.blade.php)
    ↓
Volt Component (@volt('component-name'))
    ↓
Action (Spatie QueableAction) - business logic
    ↓
Service/Model (persistenza dati)
    ↓
Risposta
```

**Nota Architetturale**: 
- ❌ **NON si usano controller** per il frontoffice
- ❌ **NON si scrivono rotte** in `web.php` o `api.php` per pagine pubbliche
- ✅ **Folio** crea rotte automaticamente da file in `resources/views/pages/`
- ✅ **Volt** gestisce interattività direttamente nelle pagine

## Integrazione Moduli

### View Rendering System
- Utilizzo di `GetViewAction` per risoluzione dinamica delle viste
- Supporto per viste temi pubblici e viste specifiche modulo
- Composizione attraverso `ThemeComposer` e `XotComposer`

### Actions Pattern
- Tutta la business logic è incapsulata in Actions
- Actions chiamate da componenti Volt, NON da controller
- Pattern Frontoffice: Folio → Blade Page → Volt Component → Action → Service/Model
- Pattern Backend (Filament): Filament Resource → Action → Service/Model

### Multi-tenancy Integration
- Ogni modulo può essere abilitato/disabilitato per tenant specifico
- Isolamento dati attraverso scope Eloquent
- Configurazioni specifiche per tenant

## File Structure per Modulo

Ogni modulo seguente struttura standard:

```
Modules/{ModuleName}/
├── Actions/          # Business logic actions
├── Config/           # Configurazioni specifiche
├── Database/         # Migrations, factories, seeders
├── Http/             # Middleware (NO controller per frontoffice)
├── Models/           # Eloquent models
├── Providers/        # Service providers
├── Resources/        # Views, assets
│   └── views/
│       └── pages/    # Pagine Folio (routing automatico)
├── Services/         # Service classes
└── Tests/            # Test specifici modulo
```

**Nota**: 
- ❌ **NON creare Routes/** per frontoffice (Folio gestisce routing)
- ❌ **NON creare Http/Controllers/** per frontoffice (usare Volt)
- ✅ **Pagine Folio** in `resources/views/pages/` = rotte automatiche

## Interdipendenze Critiche

1. **Xot** → Tutti i moduli (utilities di base)
2. **UI** → Tutti i moduli con UI (componenti condivisi)
3. **User** → Tutti i moduli con autenticazione
4. **Tenant** → Tutti i moduli con dati tenant-specifici
5. **Activity** → Tutti i moduli con logging richiesto

Questa architettura permette scalabilità, manutenibilità e riutilizzo del codice mantenendo chiara separazione delle responsabilità.