const cart = [];
const products = [
  { name: "Ecofriendly Houseware", brand: "GreenLiving", image: "images/12.jpg", price: 7.99, rating: "★★★★☆", ecoRating: "high", alternative: "Metal-free Compostable Utensils" },
  { name: "Plastic Toothbrush", brand: "GenericCo", image: "images/111.jpg", price: 2.50, rating: "★★☆☆☆", ecoRating: "low", alternative: "Bamboo Toothbrush" },
  { name: "Reusable Metal Straw", brand: "SipSmart", image: "images/222.jpg", price: 3.00, rating: "★★★☆☆", ecoRating: "medium", alternative: "Bamboo Straw" },
  { name: "Recycled Notebook", brand: "EcoWrite", image: "images/8.jpg", price: 4.75, rating: "★★★★☆", ecoRating: "high", alternative: "Digital Notes App" },
  { name: "Reusable Coffee Cup", brand: "BrandX", image: "images/3.jpg", price: 1.99, rating: "★☆☆☆☆", ecoRating: "low", alternative: "Steel Water Bottle" },
  { name: "Biodegradable Trash Bags", brand: "EarthCare", image: "images/7.jpg", price: 5.49, rating: "★★★★☆", ecoRating: "high", alternative: "Compost Bin" },
  { name: "Hemp Backpack", brand: "EarthCare", image: "images/4.jpg", price: 5.49, rating: "★★★★☆", ecoRating: "high", alternative: "Compost Bin" },
  { name: "Coconut Oil", brand: "EarthCare", image: "images/5.jpg", price: 5.49, rating: "★★★★☆", ecoRating: "high", alternative: "Compost Bin" },
  { name: "Compostable Phone Case", brand: "EarthCare", image: "images/6.jpg", price: 5.49, rating: "★★★★☆", ecoRating: "high", alternative: "Compost Bin" },
  { name: "Natural Honey", brand: "EarthCare", image: "images/9.jpg", price: 5.49, rating: "★★★★☆", ecoRating: "high", alternative: "Compost Bin" },
  { name: "Kasoori Majal", brand: "EarthCare", image: "images/10.jpg", price: 5.49, rating: "★★★★☆", ecoRating: "high", alternative: "Compost Bin" },
  { name: "Natural Soap", brand: "EarthCare", image: "images/11.jpg", price: 5.49, rating: "★★★★☆", ecoRating: "high", alternative: "Compost Bin" },
];

let showAll = false;
let filteredProducts = [...products];

function getEcoBadge(rating) {
  if (rating === "high") return '<span class="eco-badge eco-high">Eco Rating: High</span>';
  if (rating === "medium") return '<span class="eco-badge eco-medium">Eco Rating: Medium</span>';
  return '<span class="eco-badge eco-low">Eco Rating: Low</span>';
}

function renderProducts(productList = filteredProducts) {
  const container = document.getElementById("productContainer");
  container.innerHTML = "";

  const visible = showAll ? productList : productList.slice(0, 6);
  visible.forEach((p, index) => {
    container.innerHTML += `
      <div class="col-md-4 mb-4">
        <div class="product-card h-100">
          <img src="${p.image}" alt="${p.name}" class="img-fluid mb-2 rounded">
          <h5>${p.name}</h5>
          <p><strong>Brand:</strong> ${p.brand}</p>
          <div class="stars">${p.rating}</div>
          <div>${getEcoBadge(p.ecoRating)}</div>
          <div class="price"><strong>Price:</strong> $${p.price.toFixed(2)}</div>
          <p><strong>Greener Alternative:</strong> ${p.alternative}</p>
          <button class="btn btn-success w-100 add-to-cart" data-index="${index}">Add to Cart</button>
        </div>
      </div>
    `;
  });

  document.querySelectorAll('.add-to-cart').forEach(button => {
    button.onclick = () => {
      const product = visible[button.dataset.index];
      const existing = JSON.parse(localStorage.getItem("cartItems")) || [];
      if (!existing.some(item => item.name === product.name)) {
        existing.push(product);
        localStorage.setItem("cartItems", JSON.stringify(existing));
        alert("Added to cart!");
      } else {
        alert("Product already in cart!");
      }
    };
  });

  const showMoreBtn = document.getElementById("showMoreBtn");
  if (productList.length > 6) {
    showMoreBtn.style.display = "block";
    showMoreBtn.textContent = showAll ? "Show Less" : "Show More";
  } else {
    showMoreBtn.style.display = "none";
  }
}

document.getElementById("searchToggle").onclick = () => {
  const searchBar = document.getElementById("searchBarContainer");
  searchBar.style.display = searchBar.style.display === "none" ? "block" : "none";
};

document.getElementById("showMoreBtn").onclick = () => {
  showAll = !showAll;
  renderProducts();
};

document.getElementById("localSearchInput").oninput = function () {
  const term = this.value.toLowerCase();
  filteredProducts = products.filter(p =>
    p.name.toLowerCase().includes(term) || p.brand.toLowerCase().includes(term)
  );
  showAll = false;
  renderProducts();
};

document.getElementById("ecoFilter").onchange = function () {
  const selected = this.value;
  if (selected === "all") {
    filteredProducts = [...products];
  } else {
    filteredProducts = products.filter(p => p.ecoRating === selected);
  }
  showAll = false;
  renderProducts();
};

const modeToggle = document.getElementById("modeToggle");
modeToggle.onclick = () => {
  document.body.classList.toggle("dark-mode");
  const isDark = document.body.classList.contains("dark-mode");
  localStorage.setItem("ecoDarkMode", isDark);
  modeToggle.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
};

window.onload = () => {
  const savedMode = localStorage.getItem("ecoDarkMode") === "true";
  if (savedMode) {
    document.body.classList.add("dark-mode");
    modeToggle.innerHTML = '<i class="fas fa-sun"></i>';
  }
  renderProducts();
};

