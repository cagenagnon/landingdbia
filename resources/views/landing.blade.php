<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DBIA — Webinaire & Bootcamp Web | Inscriptions</title>
<link rel="icon" type="image/png" href="/logo.png">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --navy:#1B1464;
    --indigo:#4F3FF0;
    --red:#9B1C1C;
    --indigo-tint:#EDEBFC;
    --cream:#FBFAFF;
    --ink:#1A1A22;
  }
  *{ scroll-behavior:smooth; }
  body{ font-family:'DM Sans',sans-serif; color:var(--ink); background:var(--cream); }
  .font-serif-display{ font-family:'DM Serif Display',serif; }
  .eyebrow{ letter-spacing:.14em; font-weight:600; font-size:.72rem; }

  .btn-red{
    background:var(--red); color:#fff; font-weight:600;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .btn-red:hover{ transform:translateY(-2px); box-shadow:0 10px 24px -8px rgba(155,28,28,.55); }

  .btn-outline{
    border:1.5px solid var(--navy); color:var(--navy); font-weight:600;
    transition:background .15s ease, color .15s ease;
  }
  .btn-outline:hover{ background:var(--navy); color:#fff; }

  .path-line{
    height:2px;
    background:repeating-linear-gradient(90deg,var(--indigo) 0 10px, transparent 10px 18px);
  }
  .waypoint{
    width:64px; height:64px; border-radius:9999px;
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-family:'DM Serif Display',serif; font-size:1.4rem;
    box-shadow:0 12px 28px -10px rgba(79,63,240,.55);
  }

  .reveal{ opacity:0; transform:translateY(16px); transition:opacity .6s ease, transform .6s ease; }
  .reveal.in{ opacity:1; transform:translateY(0); }

  @media (prefers-reduced-motion: reduce){
    .reveal{ opacity:1 !important; transform:none !important; transition:none !important; }
    .btn-red:hover, .btn-outline:hover{ transform:none; }
  }

  .field{
    width:100%; border:1.5px solid #DCD9F2; border-radius:.6rem;
    padding:.7rem .9rem; font-size:.92rem; background:#fff;
    transition:border-color .15s ease, box-shadow .15s ease;
  }
  .field:focus{ outline:none; border-color:var(--indigo); box-shadow:0 0 0 3px rgba(79,63,240,.15); }
  .field:focus-visible{ outline:2px solid var(--indigo); outline-offset:2px; }

  .toast{
    position:fixed; bottom:24px; left:50%; transform:translateX(-50%) translateY(12px);
    background:var(--navy); color:#fff; padding:.85rem 1.4rem; border-radius:.7rem;
    font-size:.9rem; font-weight:500; opacity:0; pointer-events:none;
    transition:opacity .25s ease, transform .25s ease; z-index:50; box-shadow:0 14px 30px -10px rgba(0,0,0,.35);
  }
  .toast.show{ opacity:1; transform:translateX(-50%) translateY(0); }
</style>
</head>
<body class="antialiased">

<header class="sticky top-0 z-40 bg-(--cream)/90 backdrop-blur border-b border-black/5">
  <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
    <a href="/" class="flex items-center gap-3">
      <img src="/logo.png" alt="DBIA" class="h-10 w-auto">
      <span class="font-serif-display text-xl" style="color:var(--navy)">DBIA</span>
    </a>
    <nav class="hidden sm:flex items-center gap-6 text-sm font-medium">
      <a href="#webinaire" class="hover:opacity-70">Webinaire</a>
      <a href="#bootcamp" class="hover:opacity-70">Bootcamp</a>
      <a href="#bootcamp-form" class="btn-red px-4 py-2 rounded-full text-sm">Postuler au Bootcamp</a>
    </nav>
    <a href="#webinaire-form" class="sm:hidden btn-red px-3 py-1.5 rounded-full text-xs">S'inscrire</a>
  </div>
</header>

<section class="max-w-6xl mx-auto px-6 pt-16 pb-14 sm:pt-24 sm:pb-20">
  <p class="eyebrow inline-block px-3 py-1 rounded-full border" style="color:var(--indigo); border-color:var(--indigo)">
    INITIATIVES FORMATIONS · SEPTEMBRE 2026
  </p>
  <h1 class="font-serif-display mt-5 text-4xl sm:text-6xl leading-[1.08]" style="color:var(--navy)">
    Deux rendez-vous pour<br class="hidden sm:block"> entrer dans le digital.
  </h1>
  <p class="mt-6 max-w-xl text-base sm:text-lg text-black/70">
    Assistez au Webinaire pour découvrir les métiers du digital, puis passez à l'action
    avec le Bootcamp Web DBIA — un programme accéléré de deux semaines pour apprendre à coder.
  </p>
  <div class="mt-8 flex flex-wrap gap-4">
    <a href="#webinaire-form" class="btn-red px-6 py-3.5 rounded-full">Réserver ma place au Webinaire</a>
    <a href="#bootcamp-form" class="btn-outline px-6 py-3.5 rounded-full">Postuler au Bootcamp</a>
  </div>
  <p class="mt-5 text-sm text-black/50">26 septembre — Webinaire en ligne · 28 septembre — Lancement du Bootcamp</p>
</section>

<section class="max-w-4xl mx-auto px-6 pb-20 reveal" id="parcours">
  <div class="grid grid-cols-[64px_1fr_64px] items-center gap-4">
    <div class="waypoint" style="background:var(--indigo)">1</div>
    <div class="path-line"></div>
    <div class="waypoint" style="background:var(--red)">2</div>
  </div>
  <div class="grid grid-cols-2 gap-4 mt-3">
    <div>
      <p class="font-semibold text-sm" style="color:var(--indigo)">Webinaire — 26 septembre</p>
      <p class="text-sm text-black/60">Découvrir les métiers du digital</p>
    </div>
    <div class="text-right">
      <p class="font-semibold text-sm" style="color:var(--red)">Bootcamp — dès le 28 septembre</p>
      <p class="text-sm text-black/60">Se former aux fondamentaux du web</p>
    </div>
  </div>
</section>

<section id="webinaire" class="reveal" style="background:var(--indigo-tint)">
  <div class="max-w-6xl mx-auto px-6 py-16 sm:py-20 grid lg:grid-cols-2 gap-12 items-start">
    <div>
      <p class="eyebrow" style="color:var(--indigo)">ÉVÈNEMENT ·  26 SEPTEMBRE</p>
      <h2 class="font-serif-display text-3xl sm:text-4xl mt-3" style="color:var(--navy)">
        Webinaire : Découvrir les métiers du digital
      </h2>
      <p class="mt-5 text-black/70 leading-relaxed">
        Une session interactive dédiée aux jeunes talents. Explorez les opportunités du digital
        et les parcours de formation DBIA — dont le Bootcamp Web, qui démarre trois jours plus tard.
      </p>
      <dl class="mt-8 space-y-4 text-sm">
        <div class="flex justify-between border-b border-black/10 pb-3">
          <dt class="text-black/50">Format</dt><dd class="font-medium">En ligne, en direct</dd>
        </div>
        <div class="flex justify-between border-b border-black/10 pb-3">
          <dt class="text-black/50">Public</dt><dd class="font-medium">Jeunes talents & curieux du digital</dd>
        </div>
        <div class="flex justify-between border-b border-black/10 pb-3">
          <dt class="text-black/50">Places</dt><dd class="font-medium">100 — sur inscription</dd>
        </div>
      </dl>
    </div>

    <form id="webinaire-form" class="bg-white rounded-2xl p-7 sm:p-8 shadow-[0_20px_50px_-20px_rgba(27,20,100,.25)]">
      <h3 class="font-serif-display text-xl mb-1" style="color:var(--navy)">Réserver ma place</h3>
      <p class="text-sm text-black/50 mb-6">Gratuit — confirmation par e-mail.</p>
      <div class="space-y-4">
        <div>
          <label class="text-sm font-medium block mb-1.5" for="w-nom">Nom complet</label>
          <input id="w-nom" name="nom" required class="field" type="text" placeholder="Votre nom">
        </div>
        <div>
          <label class="text-sm font-medium block mb-1.5" for="w-email">E-mail</label>
          <input id="w-email" name="email" required class="field" type="email" placeholder="vous@exemple.com">
        </div>
        <div>
          <label class="text-sm font-medium block mb-1.5" for="w-tel">Téléphone</label>
          <input id="w-tel" name="telephone" required class="field" type="tel" placeholder="+229 ...">
        </div>
        <p data-feedback class="text-sm text-black/60 min-h-5"></p>
        <button type="submit" class="btn-red w-full py-3.5 rounded-full mt-2">Confirmer mon inscription</button>
      </div>
    </form>
  </div>
</section>

<section id="bootcamp" class="reveal">
  <div class="max-w-6xl mx-auto px-6 py-16 sm:py-20 grid lg:grid-cols-2 gap-12 items-start">
    <div>
      <p class="eyebrow" style="color:var(--red)">PRIORITAIRE · 2 SEMAINES INTENSIVES</p>
      <h2 class="font-serif-display text-3xl sm:text-4xl mt-3" style="color:var(--navy)">
        Bootcamp Web DBIA
      </h2>
      <p class="mt-5 text-black/70 leading-relaxed">
        Un programme accéléré de deux semaines, conçu pour doter les apprenants des fondamentaux
        essentiels du développement web — et les préparer à intégrer les formations complètes de la DBIA.
      </p>
      <dl class="mt-8 space-y-4 text-sm">
        <div class="flex justify-between border-b border-black/10 pb-3">
          <dt class="text-black/50">Durée</dt><dd class="font-medium">2 semaines intensives</dd>
        </div>
        <div class="flex justify-between border-b border-black/10 pb-3">
          <dt class="text-black/50">Démarrage</dt><dd class="font-medium">Lundi 28 septembre 2026</dd>
        </div>
        <div class="flex justify-between border-b border-black/10 pb-3">
          <dt class="text-black/50">Places</dt><dd class="font-medium">Candidatures limitées</dd>
        </div>
      </dl>
    </div>

    <form id="bootcamp-form" class="rounded-2xl p-7 sm:p-8" style="background:var(--navy)">
      <h3 class="font-serif-display text-xl mb-1 text-white">Postuler au Bootcamp</h3>
      <p class="text-sm text-white/60 mb-6">Réponse sous 48h après candidature.</p>
      <div class="space-y-4">
        <div>
          <label class="text-sm font-medium block mb-1.5 text-white/90" for="b-nom">Nom complet</label>
          <input id="b-nom" name="nom" required class="field" type="text" placeholder="Votre nom">
        </div>
        <div>
          <label class="text-sm font-medium block mb-1.5 text-white/90" for="b-email">E-mail</label>
          <input id="b-email" name="email" required class="field" type="email" placeholder="vous@exemple.com">
        </div>
        <div>
          <label class="text-sm font-medium block mb-1.5 text-white/90" for="b-tel">Téléphone</label>
          <input id="b-tel" name="telephone" required class="field" type="tel" placeholder="+229 ...">
        </div>
        <div>
          <label class="text-sm font-medium block mb-1.5 text-white/90" for="b-motiv">Pourquoi ce Bootcamp ?</label>
          <textarea id="b-motiv" name="motivation" rows="3" class="field" placeholder="Quelques mots sur votre motivation"></textarea>
        </div>
        <p data-feedback class="text-sm text-white/80 min-h-5"></p>
        <button type="submit" class="btn-red w-full py-3.5 rounded-full mt-2">Envoyer ma candidature</button>
      </div>
    </form>
  </div>
</section>

<footer class="border-t border-black/10">
  <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-black/50">
    <span class="flex items-center gap-2">
      <img src="/logo.png" alt="DBIA" class="h-7 w-auto">
      <span class="font-serif-display text-base" style="color:var(--navy)">DBIA</span>
    </span>
    <span>Digital Business International Academy — Bénin</span>
    <span>© 2026 DBIA. Tous droits réservés.</span>
  </div>
</footer>

<div id="toast" class="toast"></div>

<script>
  const API_BASE = '';

  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
  }, { threshold: .15 });
  revealEls.forEach(el => io.observe(el));

  function showToast(msg){
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3200);
  }

  function setFeedback(form, text, mode = 'neutral'){
    const feedback = form.querySelector('[data-feedback]');
    if (!feedback) return;

    feedback.textContent = text || '';
    feedback.classList.remove('text-black/60', 'text-white/80', 'text-red-200', 'text-red-600', 'text-green-200', 'text-green-700', 'text-amber-200', 'text-amber-600');

    const darkForm = form.id === 'bootcamp-form';
    if (mode === 'error') {
      feedback.classList.add(darkForm ? 'text-red-200' : 'text-red-600');
      return;
    }

    if (mode === 'success') {
      feedback.classList.add(darkForm ? 'text-green-200' : 'text-green-700');
      return;
    }

    if (mode === 'warning') {
      feedback.classList.add(darkForm ? 'text-amber-200' : 'text-amber-600');
      return;
    }

    feedback.classList.add(darkForm ? 'text-white/80' : 'text-black/60');
  }

  async function parseApiResponse(res){
    const payload = await res.json().catch(() => ({}));

    if (res.ok) return payload;

    if (res.status >= 500) {
      throw new Error('Service temporairement indisponible, veuillez reessayer dans un instant.');
    }

    if (res.status === 422 && payload.errors) {
      const first = Object.values(payload.errors)[0];
      const message = Array.isArray(first) ? first[0] : (payload.message || 'Veuillez vérifier le formulaire.');
      throw new Error(message);
    }

    throw new Error(payload.message || 'Erreur serveur, veuillez réessayer.');
  }

  async function handleSubmit({ formId, endpoint, loadingText, successFallback, buildBody }) {
    const form = document.getElementById(formId);
    form.addEventListener('submit', async function(e){
      e.preventDefault();
      const btn = form.querySelector('button[type="submit"]');
      const original = btn.textContent;

      setFeedback(form, loadingText, 'neutral');
      btn.textContent = loadingText;
      btn.disabled = true;

      try {
        const res = await fetch(`${API_BASE}${endpoint}`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify(buildBody(form)),
        });

        const payload = await parseApiResponse(res);
        const successMessage = payload.message || successFallback;

        setFeedback(form, successMessage, 'success');
        showToast(successMessage);

        if (Array.isArray(payload.warnings) && payload.warnings.length > 0) {
          setFeedback(form, payload.warnings[0], 'warning');
        }

        form.reset();
      } catch (err) {
        const message = err instanceof Error ? err.message : 'Une erreur est survenue, réessayez dans un instant.';
        setFeedback(form, message, 'error');
        showToast(message);
      } finally {
        btn.textContent = original;
        btn.disabled = false;
      }
    });
  }

  handleSubmit({
    formId: 'webinaire-form',
    endpoint: '/api/webinaire/inscriptions',
    loadingText: 'Envoi en cours...',
    successFallback: 'Inscription confirmée — vérifiez votre boîte mail.',
    buildBody: (form) => ({
      nom: form.nom.value,
      email: form.email.value,
      telephone: form.telephone.value,
      type_activite: 'webinaire',
    }),
  });

  handleSubmit({
    formId: 'bootcamp-form',
    endpoint: '/api/bootcamp/candidatures',
    loadingText: 'Envoi en cours...',
    successFallback: 'Candidature envoyée — vérifiez votre boîte mail.',
    buildBody: (form) => ({
      nom: form.nom.value,
      email: form.email.value,
      telephone: form.telephone.value,
      motivation: form.motivation.value,
      type_activite: 'bootcamp_web',
    }),
  });
</script>

</body>
</html>
