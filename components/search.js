
// const POSTS = <?php echo $postsJson; ?>;

const state = {
  query: "",
  categories: new Set(),   // empty = all categories
  sort: "recent",
  price: "any",
  view: "list"
};

const els = {
  input: document.getElementById("search-input"),
  form: document.getElementById("search-form"),
  found: document.getElementById("found-text"),
  results: document.getElementById("results-container"),
  categoryFilters: document.getElementById("category-filters"),
  btnList: document.getElementById("btn-list"),
  btnGrid: document.getElementById("btn-grid"),
};

function initial(name){
  return name.trim().split(/\s+/).map(p => p[0]).join("").slice(0,2).toUpperCase();
}

function timeAgo(dateStr){
  const d = new Date(dateStr);
  return d.toLocaleDateString("en-GB", { day:"numeric", month:"short", year:"numeric" });
}

// Category counts always reflect the current SEARCH TEXT only
// (filters/sort/price don't shrink the facet counts — standard faceted search behaviour).
function categoryCounts(query){
  const q = query.trim().toLowerCase();
  const base = q ? POSTS.filter(p => p.title.toLowerCase().includes(q) || p.desc.toLowerCase().includes(q)) : POSTS;
  const counts = {};
  base.forEach(p => counts[p.category] = (counts[p.category]||0) + 1);
  return counts;
}

function renderCategoryFilters(){
  const counts = categoryCounts(state.query);
  const allCats = [...new Set(POSTS.map(p => p.category))];
  els.categoryFilters.innerHTML = allCats.map(cat => `
    <label class="filter-option">
      <span class="opt-left">
        <input type="checkbox" data-cat="${cat}" ${state.categories.has(cat) ? "checked" : ""}>
        ${cat}
      </span>
      <span class="count">${counts[cat] || 0}</span>
    </label>
  `).join("");

  els.categoryFilters.querySelectorAll("input[type=checkbox]").forEach(cb => {
    cb.addEventListener("change", () => {
      const cat = cb.dataset.cat;
      cb.checked ? state.categories.add(cat) : state.categories.delete(cat);
      render();
    });
  });
}

function matchesPrice(post){
  switch(state.price){
    case "free": return post.price === 0;
    case "0-10": return post.price >= 0 && post.price <= 10;
    case "10-50": return post.price > 10 && post.price <= 50;
    case "50+": return post.price > 50;
    default: return true;
  }
}

function getFiltered(){
  const q = state.query.trim().toLowerCase();
  let list = POSTS.filter(p => {
    const matchesQuery = !q || p.title.toLowerCase().includes(q) || p.desc.toLowerCase().includes(q);
    const matchesCat = state.categories.size === 0 || state.categories.has(p.category);
    return matchesQuery && matchesCat && matchesPrice(p);
  });

  if(state.sort === "recent") list.sort((a,b) => new Date(b.date) - new Date(a.date));
  else if(state.sort === "oldest") list.sort((a,b) => new Date(a.date) - new Date(b.date));
  else if(state.sort === "popular") list.sort((a,b) => b.views - a.views);

  return list;
}

function renderResults(){
  const list = getFiltered();
  els.results.className = state.view === "grid" ? "grid-view" : "";

  if(list.length === 0){
    els.results.innerHTML = `<div class="empty-state">No results found. Try a different search term or filter.</div>`;
    return;
  }

  els.results.innerHTML = list.map(p => `
    <article class="result-card">
      <img src="${p.img}" alt="${p.title}">
      <div class="result-content">
        <span class="tag">${p.category}</span>
        <h3><a href="post.php?id=${p.id}">${p.title}</a></h3>
        <p class="result-desc">${p.desc}</p>

        <span class="meta-name-row">
          <span class="avatar">
            <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="8" r="4"></circle><path d="M4 20c0-4.4 3.6-7 8-7s8 2.6 8 7"></path></svg>
          </span>
          <span class="author-name">${p.author}</span>
        </span>

        <span class="meta-date-row">
          <span class="date-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          </span>
          <span class="author-date">${timeAgo(p.date)}</span>
        </span>

        <span class="meta-stats-row">
          <span>👁 ${p.views.toLocaleString()}</span>
          <button class="bookmark-btn" data-id="${p.id}" aria-label="Bookmark">
            <svg width="17" height="17" viewBox="0 0 24 24" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
          </button>
        </span>
      </div>
    </article>
  `).join("");

  // re-attach bookmark toggle listeners after re-render
  els.results.querySelectorAll(".bookmark-btn").forEach(btn => {
    btn.addEventListener("click", () => btn.classList.toggle("active"));
  });
}

function renderFoundText(){
  const q = state.query.trim();
  if(!q){
    els.found.textContent = "";
    return;
  }
  const count = getFiltered().length;
  els.found.innerHTML = `Found <b>${count}</b> result${count === 1 ? "" : "s"} for "<b>${q}</b>"`;
}

function render(){
  renderCategoryFilters();
  renderResults();
  renderFoundText();
}

// ---- Search input: live search as you type ----
els.input.addEventListener("input", () => {
  state.query = els.input.value;
  render();
});
els.form.addEventListener("submit", (e) => {
  e.preventDefault();
  state.query = els.input.value;
  render();
});

// ---- Sort / Price radios: auto-apply on click ----
document.querySelectorAll('input[name="sort"]').forEach(r => {
  r.addEventListener("change", () => { state.sort = r.value; render(); });
});
document.querySelectorAll('input[name="price"]').forEach(r => {
  r.addEventListener("change", () => { state.price = r.value; render(); });
});

// ---- Grid / List toggle ----
els.btnList.addEventListener("click", () => {
  state.view = "list";
  els.btnList.classList.add("active");
  els.btnGrid.classList.remove("active");
  renderResults();
});
els.btnGrid.addEventListener("click", () => {
  state.view = "grid";
  els.btnGrid.classList.add("active");
  els.btnList.classList.remove("active");
  renderResults();
});

// ---- Collapsible filter sections ----
document.querySelectorAll(".filter-title").forEach(title => {
  title.addEventListener("click", () => {
    title.closest(".filter-card").classList.toggle("collapsed");
  });
});

// ---- Initial state: box empty, found-text hidden, everything else loaded ----
els.input.value = "";
state.query = "";
render();