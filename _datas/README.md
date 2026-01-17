# Upload Supabase - Version GitHub Pages

Application d'upload de fichiers 100% JavaScript compatible avec GitHub Pages. Upload direct vers Supabase Storage sans serveur backend.

## 🎯 Avantages de cette version

- ✅ **Gratuit** : Hébergement sur GitHub Pages
- ✅ **Pas de limite Vercel** : Upload jusqu'à 50 Mo
- ✅ **Upload direct** : Client → Supabase (plus rapide)
- ✅ **Simple** : Juste HTML/CSS/JavaScript
- ✅ **Pas de serveur** : Pas besoin de PHP ou Node.js

## 📦 Fichiers nécessaires

```
votre-repo/
├── index.html          # Page principale (login + upload)
├── app.js             # Logique JavaScript
├── style.css          # Style Windows 95 rétro
└── README.md          # Ce fichier
```

## 🚀 Installation étape par étape

### 1️⃣ Configurer Supabase RLS

Sur **Supabase** → **Storage** → bucket `sons` → **Policies** → **New Policy**

#### Option A : Interface visuelle
1. Cliquez sur **New Policy**
2. Choisissez **"For full customization"**
3. **Policy name** : `Allow public uploads`
4. **Allowed operation** : `INSERT`
5. **Target roles** : `public`
6. **USING expression** : laissez vide
7. **WITH CHECK expression** : `bucket_id = 'sons'`
8. Cliquez sur **Save**

Répétez pour la lecture :
- **Policy name** : `Allow public read`
- **Allowed operation** : `SELECT`
- **USING expression** : `bucket_id = 'sons'`

#### Option B : SQL Editor
Allez dans **SQL Editor** et exécutez le code du fichier `supabase_rls_config.sql` fourni.

### 2️⃣ Modifier app.js avec vos identifiants

Ouvrez `app.js` et modifiez ces lignes :

```javascript
const CONFIG = {
    PASSWORD: 'votre-mot-de-passe',  // ← CHANGEZ ICI
    
    SUPABASE_URL: 'https://hrzmagjjobctkfxayokt.supabase.co',  // ← Votre URL
    SUPABASE_ANON_KEY: 'eyJhbGci...',  // ← Votre clé anon (publique)
    BUCKET_NAME: 'sons',  // ← Votre bucket
    
    // Le reste peut rester tel quel
};
```

**Où trouver la clé ANON ?**
- Supabase → Settings → API → **anon/public** key

### 3️⃣ Activer GitHub Pages

1. Sur GitHub, allez dans votre repo
2. **Settings** → **Pages**
3. **Source** : `Deploy from a branch`
4. **Branch** : `main` → `/root`
5. Cliquez sur **Save**

Attendez 1-2 minutes, votre site sera accessible à :
```
https://votre-username.github.io/votre-repo/
```

### 4️⃣ Tester

1. Ouvrez l'URL GitHub Pages
2. Connectez-vous avec votre mot de passe
3. Uploadez un fichier test
4. Vérifiez sur Supabase → Storage → bucket `sons`

## 🔒 Sécurité

### ⚠️ Points importants

1. **Le mot de passe est visible dans le code source**
   - C'est normal pour GitHub Pages (pas de backend)
   - Pour une vraie sécurité, utilisez Vercel ou un serveur backend
   - Cette version est OK pour un usage personnel/interne

2. **La clé `anon` est publique**
   - C'est prévu par Supabase (elle est faite pour être exposée)
   - La sécurité vient des politiques RLS

3. **Les politiques RLS sont ouvertes**
   - N'importe qui avec l'URL peut uploader
   - Pour restreindre, ajoutez des conditions dans les politiques RLS

### 🛡️ Améliorer la sécurité (optionnel)

#### Limiter par extension de fichier
```sql
CREATE POLICY "Allow specific file types"
ON storage.objects FOR INSERT TO public
WITH CHECK (
  bucket_id = 'sons' AND
  storage.extension(name) IN ('mp3', 'wav', 'ogg', 'jpg', 'png', 'gif', 'pdf')
);
```

#### Limiter la taille
```sql
CREATE POLICY "Limit file size"
ON storage.objects FOR INSERT TO public
WITH CHECK (
  bucket_id = 'sons' AND
  octet_length(decode(encode(metadata, 'escape'), 'escape')) < 52428800
);
```

## 🐛 Dépannage

### Erreur : "new row violates row-level security policy"
- ✅ Vérifiez que les politiques RLS sont bien créées
- ✅ Vérifiez que le bucket s'appelle bien `sons`

### Erreur : "Failed to fetch"
- ✅ Vérifiez l'URL Supabase dans `app.js`
- ✅ Vérifiez la clé `anon` (pas `service_role`)
- ✅ Vérifiez que le bucket existe

### Le mot de passe ne fonctionne pas
- ✅ Vérifiez la casse (majuscules/minuscules)
- ✅ Videz le cache du navigateur
- ✅ Ouvrez la console (F12) pour voir les erreurs

### Upload échoue
- ✅ Vérifiez la taille du fichier (< 50 Mo)
- ✅ Vérifiez l'extension du fichier
- ✅ Vérifiez les politiques RLS sur Supabase

## 📝 Personnalisation

### Changer le mot de passe
Dans `app.js` :
```javascript
PASSWORD: 'VotreNouveauMotDePasse123!',
```

### Ajouter des extensions
Dans `app.js` :
```javascript
ALLOWED_EXTENSIONS: ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'mp3', 'wav', 'ogg', 'mp4', 'avi'],
```

### Changer la taille max
Dans `app.js` :
```javascript
MAX_FILE_SIZE: 100 * 1024 * 1024, // 100 Mo
```

### Modifier le style
Éditez `style.css` - le style actuel est Windows 95 rétro.

## 🔄 Différences avec la version PHP

| Fonctionnalité | Version PHP | Version GitHub Pages |
|----------------|-------------|---------------------|
| Hébergement | Vercel/serveur PHP | GitHub Pages (gratuit) |
| Backend | PHP + Sessions | JavaScript pur |
| Limite upload | 4.5 Mo (Vercel free) | 50 Mo (Supabase) |
| Sécurité mot de passe | Côté serveur | Côté client |
| Upload | Serveur → Supabase | Direct client → Supabase |
| Configuration | Variables env | Fichier JS |

## 🎨 Fonctionnalités

- ✅ Authentification par mot de passe
- ✅ Upload multiple de fichiers
- ✅ Validation client (taille, extension)
- ✅ Barre de progression
- ✅ Renommage automatique unique
- ✅ Messages de succès/erreur
- ✅ Style rétro Windows 95
- ✅ Responsive design

## 📚 Ressources

- [GitHub Pages](https://pages.github.com/)
- [Supabase Storage](https://supabase.com/docs/guides/storage)
- [Row Level Security](https://supabase.com/docs/guides/auth/row-level-security)

## 💡 Améliorations futures possibles

- [ ] Hash du mot de passe avec crypto-js
- [ ] Authentification Supabase Auth
- [ ] Preview des images uploadées
- [ ] Historique des uploads
- [ ] Drag & drop de fichiers
- [ ] Compression d'images avant upload

---

**Questions ?** Consultez la documentation Supabase ou créez une issue sur GitHub !
