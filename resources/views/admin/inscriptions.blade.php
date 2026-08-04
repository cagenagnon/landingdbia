<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DBIA Admin - Inscriptions</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --navy:#1B1464;
    --red:#9B1C1C;
    --ink:#1A1A22;
    --cream:#FBFAFF;
  }
  body{ font-family:'DM Sans',sans-serif; color:var(--ink); background:var(--cream); }
  .font-serif-display{ font-family:'DM Serif Display',serif; }
  .chip{ border:1px solid rgba(27,20,100,.25); border-radius:999px; padding:.4rem .7rem; font-size:.8rem; }
  .btn{ border-radius:.65rem; padding:.55rem .9rem; font-weight:600; font-size:.88rem; }
  .btn-primary{ background:var(--navy); color:#fff; }
  .btn-outline{ border:1px solid rgba(27,20,100,.35); color:var(--navy); }
  th button{ font-weight:700; color:#111827; }
</style>
</head>
<body class="antialiased">
  <header class="border-b border-black/10 bg-white/80 backdrop-blur sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-3">
      <div>
        <p class="text-xs tracking-[.12em] font-semibold text-black/50">TABLEAU D'ADMINISTRATION</p>
        <h1 class="font-serif-display text-2xl" style="color:var(--navy)">Inscriptions DBIA</h1>
      </div>
      <span class="chip">Webinaire + Bootcamp</span>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-8 space-y-10">
    <section class="bg-white rounded-2xl border border-black/5 p-5 sm:p-6">
      <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
          <h2 class="font-serif-display text-xl" style="color:var(--navy)">Tableau 1 - Inscriptions Webinaire</h2>
          <p class="text-sm text-black/60">Recherche, tri, pagination et export CSV.</p>
        </div>
        <div class="flex gap-2">
          <input id="webinaire-search" class="border border-black/15 rounded-lg px-3 py-2 text-sm w-64" placeholder="Rechercher nom, e-mail, telephone">
          <button id="webinaire-search-btn" class="btn btn-primary">Rechercher</button>
          <button id="webinaire-export" class="btn btn-outline">Exporter CSV</button>
        </div>
      </div>

      <div class="overflow-x-auto mt-4">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="border-b border-black/10">
              <th class="text-left py-3 pr-3"><button data-table="webinaire" data-sort="nom">Nom</button></th>
              <th class="text-left py-3 pr-3"><button data-table="webinaire" data-sort="email">E-mail</button></th>
              <th class="text-left py-3 pr-3"><button data-table="webinaire" data-sort="telephone">Telephone</button></th>
              <th class="text-left py-3 pr-3"><button data-table="webinaire" data-sort="created_at">Date inscription</button></th>
              <th class="text-left py-3 pr-3"><button data-table="webinaire" data-sort="statut">Statut</button></th>
            </tr>
          </thead>
          <tbody id="webinaire-rows"></tbody>
        </table>
      </div>

      <div class="mt-4 flex items-center justify-between">
        <p id="webinaire-meta" class="text-sm text-black/60"></p>
        <div class="flex gap-2">
          <button id="webinaire-prev" class="btn btn-outline">Precedent</button>
          <button id="webinaire-next" class="btn btn-outline">Suivant</button>
        </div>
      </div>
    </section>

    <section class="bg-white rounded-2xl border border-black/5 p-5 sm:p-6">
      <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
          <h2 class="font-serif-display text-xl" style="color:var(--navy)">Tableau 2 - Candidatures Bootcamp Web</h2>
          <p class="text-sm text-black/60">Recherche, tri, pagination et export CSV.</p>
        </div>
        <div class="flex gap-2">
          <input id="bootcamp-search" class="border border-black/15 rounded-lg px-3 py-2 text-sm w-64" placeholder="Rechercher nom, e-mail, telephone">
          <button id="bootcamp-search-btn" class="btn btn-primary">Rechercher</button>
          <button id="bootcamp-export" class="btn btn-outline">Exporter CSV</button>
        </div>
      </div>

      <div class="overflow-x-auto mt-4">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="border-b border-black/10">
              <th class="text-left py-3 pr-3"><button data-table="bootcamp" data-sort="nom">Nom</button></th>
              <th class="text-left py-3 pr-3"><button data-table="bootcamp" data-sort="email">E-mail</button></th>
              <th class="text-left py-3 pr-3"><button data-table="bootcamp" data-sort="telephone">Telephone</button></th>
              <th class="text-left py-3 pr-3"><button data-table="bootcamp" data-sort="created_at">Date inscription</button></th>
              <th class="text-left py-3 pr-3"><button data-table="bootcamp" data-sort="statut">Statut</button></th>
            </tr>
          </thead>
          <tbody id="bootcamp-rows"></tbody>
        </table>
      </div>

      <div class="mt-4 flex items-center justify-between">
        <p id="bootcamp-meta" class="text-sm text-black/60"></p>
        <div class="flex gap-2">
          <button id="bootcamp-prev" class="btn btn-outline">Precedent</button>
          <button id="bootcamp-next" class="btn btn-outline">Suivant</button>
        </div>
      </div>
    </section>
  </main>

<script>
  const API_BASE = '';

  const state = {
    webinaire: { page: 1, per_page: 10, search: '', sort_by: 'created_at', sort_dir: 'desc', endpoint: '/api/admin/inscriptions/webinaire' },
    bootcamp: { page: 1, per_page: 10, search: '', sort_by: 'created_at', sort_dir: 'desc', endpoint: '/api/admin/inscriptions/bootcamp' },
  };

  function queryString(params){
    const qp = new URLSearchParams(params);
    return qp.toString();
  }

  function formatDate(value){
    if (!value) return '-';
    return new Date(value).toLocaleString('fr-FR');
  }

  function renderRows(table, rows){
    const tbody = document.getElementById(`${table}-rows`);
    if (!rows || rows.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="py-6 text-center text-black/50">Aucune inscription trouvee.</td></tr>';
      return;
    }

    tbody.innerHTML = rows.map((row) => `
      <tr class="border-b border-black/5">
        <td class="py-3 pr-3">${row.nom ?? '-'}</td>
        <td class="py-3 pr-3">${row.email ?? '-'}</td>
        <td class="py-3 pr-3">${row.telephone ?? '-'}</td>
        <td class="py-3 pr-3">${formatDate(row.created_at)}</td>
        <td class="py-3 pr-3">${row.statut ?? '-'}</td>
      </tr>
    `).join('');
  }

  function renderMeta(table, meta){
    const el = document.getElementById(`${table}-meta`);
    el.textContent = `Page ${meta.current_page} / ${meta.last_page} - ${meta.total} inscription(s)`;

    document.getElementById(`${table}-prev`).disabled = meta.current_page <= 1;
    document.getElementById(`${table}-next`).disabled = meta.current_page >= meta.last_page;
  }

  async function loadTable(table){
    const st = state[table];
    const url = `${API_BASE}${st.endpoint}?${queryString({
      page: st.page,
      per_page: st.per_page,
      search: st.search,
      sort_by: st.sort_by,
      sort_dir: st.sort_dir,
    })}`;

    const res = await fetch(url, { headers: { Accept: 'application/json' } });
    const payload = await res.json();
    if (!res.ok) {
      throw new Error(payload.message || 'Erreur API admin');
    }

    renderRows(table, payload.data);
    renderMeta(table, payload.meta);
  }

  function bindSearch(table){
    const input = document.getElementById(`${table}-search`);
    document.getElementById(`${table}-search-btn`).addEventListener('click', async () => {
      state[table].search = input.value.trim();
      state[table].page = 1;
      await loadTable(table);
    });
  }

  function bindPagination(table){
    document.getElementById(`${table}-prev`).addEventListener('click', async () => {
      if (state[table].page > 1) {
        state[table].page -= 1;
        await loadTable(table);
      }
    });

    document.getElementById(`${table}-next`).addEventListener('click', async () => {
      state[table].page += 1;
      await loadTable(table);
    });
  }

  function bindSorting(){
    document.querySelectorAll('button[data-sort]').forEach((button) => {
      button.addEventListener('click', async () => {
        const table = button.dataset.table;
        const sortBy = button.dataset.sort;
        const current = state[table];

        if (current.sort_by === sortBy) {
          current.sort_dir = current.sort_dir === 'asc' ? 'desc' : 'asc';
        } else {
          current.sort_by = sortBy;
          current.sort_dir = 'asc';
        }

        current.page = 1;
        await loadTable(table);
      });
    });
  }

  function bindExport(table, endpoint){
    document.getElementById(`${table}-export`).addEventListener('click', () => {
      const st = state[table];
      const url = `${API_BASE}${endpoint}?${queryString({ search: st.search })}`;
      window.open(url, '_blank');
    });
  }

  async function init(){
    bindSearch('webinaire');
    bindSearch('bootcamp');
    bindPagination('webinaire');
    bindPagination('bootcamp');
    bindSorting();
    bindExport('webinaire', '/api/admin/inscriptions/webinaire/export');
    bindExport('bootcamp', '/api/admin/inscriptions/bootcamp/export');

    try {
      await Promise.all([loadTable('webinaire'), loadTable('bootcamp')]);
    } catch (error) {
      alert(error.message || 'Impossible de charger les donnees admin.');
    }
  }

  init();
</script>
</body>
</html>
