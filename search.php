<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results — Inkora</title>
  <link rel="stylesheet" href="components/search.css">
</head>

<body>

  <div class="search-page-wrap">

    <!--Search bar-->
    <div class="hero-banner">
      <h1>Search Results</h1>
      <form class="search-box" id="search-form" autocomplete="off">
        <input type="text" id="search-input" name="q" placeholder="Search Inkora" value="">
        <button type="submit" aria-label="Search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </button>
      </form>
    </div>

    <div class="search-layout">

      <!--Sidebar filters-->
      <aside>
        <div class="filter-card" data-filter="categories">
          <div class="filter-title">
            <span>Categories</span>
            <svg class="chev" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg>
          </div>
          <div class="filter-body" id="category-filters"><!--injected by JS--></div>
        </div>

        <div class="filter-card" data-filter="sort">
          <div class="filter-title">
            <span>Sort By</span>
            <svg class="chev" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg>
          </div>
          <div class="filter-body">
            <label class="filter-option"><span class="opt-left"><input type="radio" name="sort" value="recent" checked> Most Recent</span></label>
            <label class="filter-option"><span class="opt-left"><input type="radio" name="sort" value="popular"> Most Popular</span></label>
            <label class="filter-option"><span class="opt-left"><input type="radio" name="sort" value="oldest"> Oldest First</span></label>
          </div>
        </div>

        <div class="filter-card" data-filter="price">
          <div class="filter-title">
            <span>Price Range</span>
            <svg class="chev" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg>
          </div>
          <div class="filter-body">
            <label class="filter-option"><span class="opt-left"><input type="radio" name="price" value="any" checked> Any</span></label>
            <label class="filter-option"><span class="opt-left"><input type="radio" name="price" value="free"> Free</span></label>
            <label class="filter-option"><span class="opt-left"><input type="radio" name="price" value="0-10"> $0 - $10</span></label>
            <label class="filter-option"><span class="opt-left"><input type="radio" name="price" value="10-50"> $10 - $50</span></label>
            <label class="filter-option"><span class="opt-left"><input type="radio" name="price" value="50+"> $50+</span></label>
          </div>
        </div>
      </aside>

      <!--Results-->
      <section>
        <div class="results-header">
          <div id="found-text"></div>
          <div class="view-toggle">
            <button type="button" id="btn-list" class="active" aria-label="List view">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
            </button>
            <button type="button" id="btn-grid" aria-label="Grid view">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </button>
          </div>
        </div>

        <div id="results-container"><!--injected by JS--></div>
      </section>

    </div>
  </div>

  <script>

  // price: 0 = Free, otherwise numeric price used for the price-range filter.
  const POSTS = [
    {"id":1,"title":"Exploring the Hidden Gems of Sri Lanka","desc":"Sri Lanka is a land of breathtaking landscapes, rich culture, and warm hospitality. From misty mountains to golden beaches, there are countless hidden gems waiting to be discovered.","category":"Travel","author":"Manuja Perera","date":"2026-09-08","views":1200,"price":0,"img":"https://picsum.photos/seed/srilanka/400/300"},
    {"id":2,"title":"Top 10 Beaches to Visit in 2026","desc":"Crystal clear waters, golden sands, and unforgettable sunsets — these are the top 10 beaches you should visit in 2026, whether you're after adventure or relaxation.","category":"Travel","author":"Senuri Jayasinghe","date":"2026-09-05","views":984,"price":0,"img":"https://picsum.photos/seed/beaches/400/300"},
    {"id":3,"title":"Travel on a Budget","desc":"Discover how to explore the world without breaking the bank. With the right planning and a few smart tips, traveling on a budget can be both exciting and rewarding.","category":"Travel","author":"Dinuka Fernando","date":"2026-09-02","views":756,"price":0,"img":"https://picsum.photos/seed/budget/400/300"},
    {"id":4,"title":"Best Travel Destinations for 2026","desc":"From tropical islands to historic cities, here are the best travel destinations for 2026. Plan your next adventure and explore places that inspire.","category":"Travel","author":"Nethmi Silva","date":"2026-08-29","views":643,"price":0,"img":"https://picsum.photos/seed/destinations/400/300"},
    {"id":5,"title":"Solo Travel: A Complete Guide","desc":"Everything you need to know before setting off on your first solo trip, from safety tips to making the most of your own company.","category":"Travel","author":"Kavindu Rathnayake","date":"2026-08-20","views":512,"price":10,"img":"https://picsum.photos/seed/solotravel/400/300"},
    {"id":6,"title":"Packing Light: Travel Smarter","desc":"A minimalist's guide to packing everything you need for weeks abroad in a single carry-on bag.","category":"Travel","author":"Ishara Wickrama","date":"2026-08-11","views":390,"price":25,"img":"https://picsum.photos/seed/packing/400/300"},
    {"id":7,"title":"The Rise of AI in Everyday Apps","desc":"AI is quietly reshaping the apps we use every day. Here's a look at how machine learning is changing the software landscape.","category":"Technology","author":"Ruwan Jayasuriya","date":"2026-09-07","views":2100,"price":0,"img":"https://picsum.photos/seed/aiapps/400/300"},
    {"id":8,"title":"Web Development Trends in 2026","desc":"From server components to edge rendering, here's what's shaping how developers build for the web this year.","category":"Technology","author":"Sachini Gunawardena","date":"2026-09-01","views":1430,"price":15,"img":"https://picsum.photos/seed/webdev/400/300"},
    {"id":9,"title":"Choosing Your First Laptop for Coding","desc":"A practical buyer's guide for students and new developers picking their first programming laptop.","category":"Technology","author":"Tharindu Bandara","date":"2026-08-22","views":860,"price":0,"img":"https://picsum.photos/seed/laptop/400/300"},
    {"id":10,"title":"Minimalist Living: Less is More","desc":"How decluttering your home and your schedule can lead to a calmer, more intentional lifestyle.","category":"Lifestyle","author":"Amaya Perera","date":"2026-09-06","views":670,"price":0,"img":"https://picsum.photos/seed/minimal/400/300"},
    {"id":11,"title":"Building a Morning Routine That Sticks","desc":"Small, sustainable habits that make mornings calmer and set the tone for a productive day.","category":"Lifestyle","author":"Hiruni Fonseka","date":"2026-08-28","views":540,"price":5,"img":"https://picsum.photos/seed/morning/400/300"},
    {"id":12,"title":"Online Learning: Tips for Staying Focused","desc":"Practical strategies for university students to stay engaged and motivated during online lectures.","category":"Education","author":"Chamod Silva","date":"2026-09-03","views":430,"price":0,"img":"https://picsum.photos/seed/online-learning/400/300"},
    {"id":13,"title":"How to Prepare for Final Exams","desc":"A step-by-step study plan to help you revise efficiently and walk into your final exams with confidence.","category":"Education","author":"Piumi Wijesinghe","date":"2026-08-18","views":810,"price":0,"img":"https://picsum.photos/seed/exams/400/300"},
    {"id":14,"title":"5 Healthy Breakfast Recipes","desc":"Quick, nutritious breakfast ideas that take less than 15 minutes to prepare on busy mornings.","category":"Food","author":"Nadeesha Kumari","date":"2026-09-04","views":390,"price":0,"img":"https://picsum.photos/seed/breakfast/400/300"},
    {"id":15,"title":"A Taste of Sri Lankan Street Food","desc":"From kottu to isso wade, take a tour through the flavours that make Sri Lankan street food unforgettable.","category":"Food","author":"Manuja Perera","date":"2026-08-25","views":710,"price":0,"img":"https://picsum.photos/seed/streetfood/400/300"},
    {"id":16,"title":"Simple Habits for Better Sleep","desc":"Evidence-based habits that can help you fall asleep faster and wake up feeling more rested.","category":"Health","author":"Dr. Ashan Perera","date":"2026-09-09","views":980,"price":0,"img":"https://picsum.photos/seed/sleep/400/300"},
    {"id":17,"title":"Staying Active While Working from Home","desc":"Easy ways to stay active and avoid burnout when your commute is just a few steps to your desk.","category":"Health","author":"Sanduni Perera","date":"2026-08-14","views":455,"price":60,"img":"https://picsum.photos/seed/wfhactive/400/300"}
  ];

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

  // Category counts reflect the current SEARCH TEXT only

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

    // bookmark toggle listeners after re-render
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

  // Search input 
  els.input.addEventListener("input", () => {
    state.query = els.input.value;
    render();
  });
  els.form.addEventListener("submit", (e) => {
    e.preventDefault();
    state.query = els.input.value;
    render();
  });

  // Sort radios: auto-apply on click
  document.querySelectorAll('input[name="sort"]').forEach(r => {
    r.addEventListener("change", () => { state.sort = r.value; render(); });
  });
  document.querySelectorAll('input[name="price"]').forEach(r => {
    r.addEventListener("change", () => { state.price = r.value; render(); });
  });

  // Grid / List toggle
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

  // Collapsible filter sections
  document.querySelectorAll(".filter-title").forEach(title => {
    title.addEventListener("click", () => {
      title.closest(".filter-card").classList.toggle("collapsed");
    });
  });

  // Initial state: box empty, found-text hidden, everything else loaded
  els.input.value = "";
  state.query = "";
  render();
  </script>

</body>
</html>