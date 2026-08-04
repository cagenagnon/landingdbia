# Checklist de validation integration frontend/backend

## A. API inscriptions

- [ ] `POST /api/webinaire/inscriptions` retourne `201` sur payload valide.
- [ ] `POST /api/bootcamp/candidatures` retourne `201` sur payload valide.
- [ ] `POST` invalide retourne `422` avec details `errors`.
- [ ] Les champs enregistres incluent:
  - [ ] `nom`
  - [ ] `email`
  - [ ] `telephone`
  - [ ] autres champs formulaire (`motivation` pour bootcamp)
  - [ ] `type_activite` (`webinaire` ou `bootcamp_web`)
  - [ ] `statut`

## B. Frontend soumission

- [ ] Bouton passe en etat chargement pendant l'envoi.
- [ ] Message succes visible apres `201`.
- [ ] Message validation clair en cas de `422`.
- [ ] Message erreur technique en cas de `500`/reseau.
- [ ] Formulaire reset seulement apres succes.

## C. E-mails

- [ ] Inscription est enregistree meme si SMTP echoue.
- [ ] Une erreur e-mail est loggee cote backend.
- [ ] Le frontend peut afficher un warning d'e-mail non envoye.
- [ ] Templates email webinaire/bootcamp sont bien rendus.

## D. Admin

- [ ] `/admin/inscriptions` charge correctement.
- [ ] Tableau webinaire affiche nom, e-mail, telephone, date, statut.
- [ ] Tableau bootcamp affiche nom, e-mail, telephone, date, statut.
- [ ] Recherche fonctionne sur nom/e-mail/telephone.
- [ ] Tri fonctionne (nom, email, telephone, date, statut).
- [ ] Pagination fonctionne.
- [ ] Export CSV fonctionne pour les deux tableaux.

## E. Base de donnees

- [ ] Migrations executees sans erreur.
- [ ] Index existants sur email, telephone, created_at, statut.
- [ ] Donnees persistantes visibles via admin.

## F. End-to-end rapide

- [ ] Soumettre formulaire webinaire depuis frontend.
- [ ] Verifier insertion en base.
- [ ] Verifier apparition dans admin webinaire.
- [ ] Soumettre formulaire bootcamp depuis frontend.
- [ ] Verifier insertion en base.
- [ ] Verifier apparition dans admin bootcamp.

## G. Production readiness

- [ ] CORS configure selon domaine frontend.
- [ ] SMTP configure et teste.
- [ ] Middleware auth ajoute sur routes admin.
- [ ] Variables d'environnement verifiees (.env).
- [ ] Backup/monitoring logs actifs.
