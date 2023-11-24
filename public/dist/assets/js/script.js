// Event delegation
const on = (selector, eventType, childSelector, eventHandler) => {
  const elements = document.querySelectorAll(selector);
  for (element of elements) {
    element.addEventListener(eventType, (eventOnElement) => {
      if (eventOnElement.target.closest(childSelector)) {
        eventHandler(eventOnElement);
      }
    });
  }
};

// AnimateCSS
const animateCSS = (element, animation, prefix = "animate__") => {
  return new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    const node = element;

    node.classList.add(`${prefix}animated`, `${prefix}faster`, animationName);

    const handleAnimationEnd = (event) => {
      event.stopPropagation();
      node.classList.remove(
        `${prefix}animated`,
        `${prefix}faster`,
        animationName
      );
      resolve("Animation Ended.");
    };

    node.addEventListener("animationend", handleAnimationEnd, { once: true });
  });
};

// Viewport Width
// Define our viewportWidth variable
let viewportWidth;

// Set/update the viewportWidth value
const setViewportWidth = () => {
  viewportWidth = window.innerWidth || document.documentElement.clientWidth;
};

// Watch the viewport width
const watchWidth = () => {
  const sm = 640;
  const md = 768;
  const lg = 1024;
  const xl = 1280;

  const menuBar = document.querySelector(".menu-bar");

  // Hide Menu Detail
  const hideMenuDetail = () => {
    menuBar.querySelectorAll(".menu-detail.open").forEach((menuDetail) => {
      hideOverlay();

      if (!menuBar.classList.contains("menu-wide")) {
        menuDetail.classList.remove("open");
      }
    });
  };

  // Hide Sidebar
  const hideSidebar = () => {
    const sidebar = document.querySelector(".sidebar");

    if (!sidebar) return;

    if (sidebar.classList.contains("open")) {
      sidebar.classList.remove("open");
      hideOverlay();
    }
  };

  if (viewportWidth < sm) {
    if (!menuBar) return;

    const openMenu = menuBar.querySelector(".menu-detail.open");

    if (!openMenu) {
      menuBar.classList.add("menu-hidden");
      document.documentElement.classList.add("menu-hidden");
      hideMenuDetail();
    }
  }

  if (viewportWidth > sm) {
    if (!menuBar) return;

    menuBar.classList.remove("menu-hidden");
    document.documentElement.classList.remove("menu-hidden");
  }

  if (viewportWidth > lg) {
    hideSidebar();
  }
};

// Set our initial width
setViewportWidth();
watchWidth();

// On resize events, recalculate
window.addEventListener(
  "resize",
  () => {
    setViewportWidth();
    watchWidth();
  },
  false
);

// Open Collapse
const openCollapse = (collapse, callback) => {
  collapse.style.transitionProperty = "height, opacity";
  collapse.style.transitionDuration = "200ms";
  collapse.style.transitionTimingFunction = "ease-in-out";

  setTimeout(() => {
    collapse.style.height = collapse.scrollHeight + "px";
    collapse.style.opacity = 1;
  }, 200);

  collapse.addEventListener(
    "transitionend",
    () => {
      collapse.classList.add("open");

      collapse.style.removeProperty("height");
      collapse.style.removeProperty("opacity");

      collapse.style.removeProperty("transition-property");
      collapse.style.removeProperty("transition-duration");
      collapse.style.removeProperty("transition-timing-function");

      if (typeof callback === "function") callback();
    },
    { once: true }
  );
};

// Close Collapse
const closeCollapse = (collapse, callback) => {
  collapse.style.overflowY = "hidden";
  collapse.style.height = collapse.scrollHeight + "px";

  collapse.style.transitionProperty = "height, opacity";
  collapse.style.transitionDuration = "200ms";
  collapse.style.transitionTimingFunction = "ease-in-out";

  setTimeout(() => {
    collapse.style.height = 0;
    collapse.style.opacity = 0;
  }, 200);

  collapse.addEventListener(
    "transitionend",
    () => {
      collapse.classList.remove("open");

      collapse.style.removeProperty("overflow-y");
      collapse.style.removeProperty("height");
      collapse.style.removeProperty("opacity");

      collapse.style.removeProperty("transition-property");
      collapse.style.removeProperty("transition-duration");
      collapse.style.removeProperty("transition-timing-function");

      if (typeof callback === "function") callback();
    },
    { once: true }
  );
};

document.addEventListener("DOMContentLoaded", () => {
  // Carousel
  const carousel = document.getElementById("carousel-style-1");
  if (carousel) {
    const dir = () => {
      if (document.dir == "rtl") {
        return "rtl";
      } else {
        return "ltr";
      }
    };

    new Glide(carousel, {
      direction: dir(),
      type: "carousel",
      perView: 4,
      gap: 20,
      breakpoints: {
        640: {
          perView: 1,
        },
        768: {
          perView: 2,
        },
      },
    }).mount();
  }

  // Editors
  // CKEditor
  const editor = document.getElementById("ckeditor");
  if (editor) {
    ClassicEditor.create(editor);
  }

  // Sortable
  let element = null;

  element = document.getElementById("sortable-style-1");
  if (element) {
    const sortable = Sortable.create(element, {
      animation: 150,
    });
  }

  element = document.getElementById("sortable-style-2");
  if (element) {
    const sortable = Sortable.create(element, {
      handle: ".handle",
      animation: 150,
    });
  }

  element = document.getElementById("sortable-style-3");
  if (element) {
    const sortable = Sortable.create(element, {
      animation: 150,
    });
  }
});

// Alerts
const alerts = () => {
  // Close
  const closeAlert = (alert) => {
    alert.style.overflowY = "hidden";
    alert.style.height = alert.offsetHeight + "px";

    animateCSS(alert, "fadeOut").then(() => {
      alert.style.transitionProperty =
        "height, margin, padding, border, opacity";
      alert.style.transitionDuration = "200ms";
      alert.style.transitionTimingFunction = "linear";

      alert.style.opacity = 0;
      alert.style.height = 0;
      alert.style.marginTop = 0;
      alert.style.marginBottom = 0;
      alert.style.paddingTop = 0;
      alert.style.paddingBottom = 0;
      alert.style.border = 0;
    });

    alert.addEventListener(
      "transitionend",
      () => {
        alert.parentNode ? alert.parentNode.removeChild(alert) : false;
      },
      { once: true }
    );
  };

  on(".alert", "click", '[data-dismiss="alert"]', (event) => {
    const alert = event.target.closest(".alert");
    closeAlert(alert);
  });
};

alerts();

// Cards
const cards = () => {
  // Toggle Card Selection
  const toggleCardSelection = (event) => {
    const card = event.target.closest(".card");
    card.classList.toggle("card_selected");
  };

  on("body", "click", '[data-toggle="cardSelection"]', (event) => {
    toggleCardSelection(event);
  });

  // Toggle Row Selection
  const toggleRowSelection = (event) => {
    const row = event.target.closest("tr");
    row.classList.toggle("row_selected");
  };

  on("body", "click", '[data-toggle="rowSelection"]', (event) => {
    toggleRowSelection(event);
  });
};

cards();

// Collapse
const collapse = () => {
  const selector = '[data-toggle="collapse"]';

  // Toggle Collapse
  const toggleCollapse = (collapseTrigger) => {
    collapseTrigger.classList.toggle("active");

    // Collapse
    const collapses = document.querySelectorAll(collapseTrigger.dataset.target);
    collapses.forEach((collapse) => {
      if (collapse.classList.contains("open")) {
        closeCollapse(collapse);
      } else {
        openCollapse(collapse);
      }
    });

    // Accordion
    const accordion = collapseTrigger.closest(".accordion");
    if (accordion) {
      const accordionTriggers = accordion.querySelectorAll(selector);
      accordionTriggers.forEach((accordionTrigger) => {
        if (accordionTrigger !== collapseTrigger) {
          accordionTrigger.classList.remove("active");
        }
      });

      const accordions = accordion.querySelectorAll(".collapse");
      accordions.forEach((accordion) => {
        if (accordion.classList.contains("open")) {
          closeCollapse(accordion);
        }
      });
    }
  };

  on("body", "click", selector, (event) => {
    const collapseTrigger = event.target.closest(selector);
    toggleCollapse(collapseTrigger);
  });
};

collapse();

// Customizer
const customizer = () => {
  const root = document.documentElement;
  const menuBar = document.querySelector(".menu-bar");

  const checkSettings = () => {
    const sidebarCustomizer = document.getElementById("customizer");

    if (sidebarCustomizer) {
      // Dark Mode
      const scheme = localStorage.getItem("scheme");

      const darkModeToggler = sidebarCustomizer.querySelector(
        '[data-toggle="dark-mode"]'
      );

      if (scheme) {
        darkModeToggler.checked = true;
      } else {
        darkModeToggler.checked = false;
      }

      // RTL
      const dir = localStorage.getItem("dir");

      if (dir) {
        document.dir = dir;

        const rtl = sidebarCustomizer.querySelector('[data-toggle="rtl"]');

        if (dir === "rtl") {
          rtl.checked = true;
        } else {
          rtl.checked = false;
        }
      }

      // Branded Menu
      let brandedMenu = localStorage.getItem("brandedMenu");

      const brandedMenuToggler = sidebarCustomizer.querySelector(
        '[data-toggle="branded-menu"]'
      );

      if (brandedMenu && menuBar) {
        root.classList.add("menu_branded");
        menuBar.classList.add("menu_branded");

        brandedMenuToggler.checked = true;
      } else {
        brandedMenuToggler.checked = false;
      }

      // Menu Type
      let menuType = localStorage.getItem("menuType");

      if (menuType) {
        menuType = menuType.replace("menu-", "");
      } else {
        menuType = "default";
      }

      const menuTypeInput = sidebarCustomizer.querySelector(
        "[data-value='" + menuType + "']"
      );

      menuTypeInput.checked = true;

      // Theme
      let theme = localStorage.getItem("theme");

      let themeToggler;

      if (theme) {
        root.classList.add("theme-" + theme);

        themeToggler = sidebarCustomizer.querySelector(
          "[data-toggle='theme'][data-value='" + theme + "']"
        );
      } else {
        themeToggler = sidebarCustomizer.querySelector(
          "[data-toggle='theme'][data-value='default']"
        );
      }

      if (themeToggler) {
        themeToggler.classList.add("active");
      }

      // Gray
      let gray = localStorage.getItem("gray");

      let grayToggler;

      if (gray) {
        root.classList.add("gray-" + gray);

        grayToggler = sidebarCustomizer.querySelector(
          "[data-toggle='gray'][data-value='" + gray + "']"
        );
      } else {
        grayToggler = sidebarCustomizer.querySelector(
          "[data-toggle='gray'][data-value='default']"
        );
      }

      if (grayToggler) {
        grayToggler.classList.add("active");
      }

      // Font
      let font = localStorage.getItem("font");

      let fontToggler;

      if (font) {
        root.classList.add("font-" + font);

        fontToggler = sidebarCustomizer.querySelector(
          "[data-toggle='font'][data-value='" + font + "']"
        );
      } else {
        fontToggler = sidebarCustomizer.querySelector(
          "[data-toggle='font'][data-value='default']"
        );
      }

      if (fontToggler) {
        fontToggler.classList.add("active");
      }
    }
  };

  // Toggle Customizer
  const toggleCustomizer = () => {
    const customizer = document.getElementById("customizer");

    if (customizer.classList.contains("open")) {
      customizer.classList.remove("open");
    } else {
      checkSettings();

      customizer.classList.add("open");
    }
  };

  // Toggle RTL
  const toggleRTL = () => {
    if (document.dir === "ltr") {
      document.dir = "rtl";
      localStorage.setItem("dir", "rtl");
    } else {
      document.dir = "ltr";
      localStorage.setItem("dir", "ltr");
    }
  };

  // Toggle Branded Menu
  const toggleBrandedMenu = () => {
    if (root.classList.contains("menu_branded")) {
      root.classList.remove("menu_branded");
      menuBar.classList.remove("menu_branded");

      localStorage.removeItem("brandedMenu");
    } else {
      root.classList.add("menu_branded");
      menuBar.classList.add("menu_branded");

      localStorage.setItem("brandedMenu", "menu_branded");
    }
  };

  // Switch Theme
  const switchTheme = (themeToggler) => {
    const customizer = document.getElementById("customizer");

    customizer
      .querySelectorAll("[data-toggle='theme']")
      .forEach((themeTogger) => {
        themeTogger.classList.remove("active");
      });

    themeToggler.classList.add("active");

    const theme = themeToggler.dataset.value;

    root.classList.forEach((value) => {
      if (value.startsWith("theme-")) {
        root.classList.remove(value);
      }
    });

    if (theme == "default") {
      localStorage.removeItem("theme");
    } else {
      root.classList.add("theme-" + theme);
      localStorage.setItem("theme", theme);
    }

    const event = new Event("ThemeChanged");
    document.dispatchEvent(event);
  };

  // Switch Gray
  const switchGray = (grayToggler) => {
    const customizer = document.getElementById("customizer");

    customizer
      .querySelectorAll("[data-toggle='gray']")
      .forEach((grayTogger) => {
        grayTogger.classList.remove("active");
      });

    grayToggler.classList.add("active");

    const gray = grayToggler.dataset.value;

    root.classList.forEach((value) => {
      if (value.startsWith("gray-")) {
        root.classList.remove(value);
      }
    });

    if (gray == "default") {
      localStorage.removeItem("gray");
    } else {
      root.classList.add("gray-" + gray);
      localStorage.setItem("gray", gray);
    }

    const event = new Event("ThemeChanged");
    document.dispatchEvent(event);
  };

  // Switch Font
  const switchFont = (fontToggler) => {
    const customizer = document.getElementById("customizer");

    customizer
      .querySelectorAll("[data-toggle='font']")
      .forEach((fontTogger) => {
        fontTogger.classList.remove("active");
      });

    fontToggler.classList.add("active");

    const font = fontToggler.dataset.value;

    root.classList.forEach((value) => {
      if (value.startsWith("font-")) {
        root.classList.remove(value);
      }
    });

    if (font == "default") {
      localStorage.removeItem("font");
    } else {
      root.classList.add("font-" + font);
      localStorage.setItem("font", font);
    }

    const event = new Event("ThemeChanged");
    document.dispatchEvent(event);

    location.reload();
  };

  on("#customizer", "click", '[data-toggle="dark-mode"]', () => {
    const darkModeToggler = document.getElementById("darkModeToggler");
    darkModeToggler.click();
  });

  on("#customizer", "click", '[data-toggle="rtl"]', () => {
    toggleRTL();
  });

  on("#customizer", "click", '[data-toggle="branded-menu"]', () => {
    if (menuBar) {
      toggleBrandedMenu();
    }
  });

  on("#customizer", "click", '[data-toggle="theme"]', (event) => {
    const themeToggler = event.target.closest("[data-toggle='theme']");
    switchTheme(themeToggler);
  });

  on("#customizer", "click", '[data-toggle="gray"]', (event) => {
    const grayToggler = event.target.closest("[data-toggle='gray']");
    switchGray(grayToggler);
  });

  on("#customizer", "click", '[data-toggle="font"]', (event) => {
    const fontToggler = event.target.closest("[data-toggle='font']");
    switchFont(fontToggler);
  });

  on("#customizer", "click", '[data-toggle="customizer"]', () => {
    toggleCustomizer();
  });

  checkSettings();
};

customizer();

// Dark Mode
const darkMode = () => {
  const root = document.documentElement;

  const scheme = localStorage.getItem("scheme");

  scheme && root.classList.add(scheme);

  const darkModeToggler = document.getElementById("darkModeToggler");

  if (!darkModeToggler) return;

  if (scheme === "dark") {
    darkModeToggler.checked = "checked";
  }

  // Enable Dark Mode
  const enableDarkMode = () => {
    root.classList.remove("light");
    root.classList.add("dark");
    localStorage.setItem("scheme", "dark");
  };

  // Disable Dark Mode
  const disableDarkMode = () => {
    root.classList.remove("dark");
    root.classList.add("light");
    localStorage.removeItem("scheme");
  };

  // Check Dark Mode
  const checkDarkMode = () => {
    if (root.classList.contains("dark")) {
      return true;
    } else {
      return false;
    }
  };

  on("body", "change", "#darkModeToggler", () => {
    if (checkDarkMode()) {
      disableDarkMode();
    } else {
      enableDarkMode();
    }
  });
};

darkMode();

if (typeof Chart !== "undefined") {
  // Colors
  let colors = {};
  let font = {};

  const style = getComputedStyle(document.body);

  colors.primary = style.getPropertyValue("--color-primary");
  colors.text = style.getPropertyValue("--color-text-normal");
  font.body = style.getPropertyValue("--font-body");

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    colors.primary = style.getPropertyValue("--color-primary");
  });

  // Tooltips Options
  const tooltipOptions = {
    backgroundColor: "white",
    borderColor: "rgb(" + colors.primary + ")",
    borderWidth: 0.5,
    bodyColor: "rgb(" + colors.text + ")",
    bodySpacing: 8,
    cornerRadius: 4,
    padding: 16,
    titleColor: "rgb(" + colors.primary + ")",
  };

  // Chart defaults
  Chart.defaults.color = "rgb(" + colors.text + ")";
  Chart.defaults.font.family = font.body;

  // REGISTER CHART TYPES
  // Line with shadow element
  class LineWithShadowElement extends Chart.elements.LineElement {
    draw(ctx) {
      const originalStroke = ctx.stroke;

      ctx.stroke = function () {
        ctx.save();
        ctx.shadowColor = "rgba(0, 0, 0, 0.25)";
        ctx.shadowBlur = 8;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 4;
        originalStroke.apply(this, arguments);
        ctx.restore();
      };

      Chart.elements.LineElement.prototype.draw.apply(this, arguments);
    }
  }

  LineWithShadowElement.id = "lineWithShadowElement";

  Chart.register(LineWithShadowElement);

  // Line with shadow
  class LineWithShadow extends Chart.controllers.line {}

  LineWithShadow.id = "lineWithShadow";
  LineWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(LineWithShadow);

  // Bar with shadow
  class BarWithShadow extends Chart.controllers.bar {
    draw(ease) {
      const ctx = this.chart.ctx;

      Chart.controllers.bar.prototype.draw.call(this, ease);
      ctx.save();
      ctx.shadowColor = "rgba(0, 0, 0, 0.25)";
      ctx.shadowBlur = 8;
      ctx.shadowOffsetX = 0;
      ctx.shadowOffsetY = 4;
      Chart.controllers.bar.prototype.draw.apply(this, arguments);
      ctx.restore();
    }
  }

  BarWithShadow.id = "barWithShadow";

  Chart.register(BarWithShadow);

  // Pie with shadow
  class PieWithShadow extends Chart.controllers.pie {}

  PieWithShadow.id = "pieWithShadow";
  PieWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(PieWithShadow);

  // Doughnut with shadow
  class DoughnutWithShadow extends Chart.controllers.doughnut {}

  DoughnutWithShadow.id = "doughnutWithShadow";
  DoughnutWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(DoughnutWithShadow);

  // Radar with shadow
  class RadarWithShadow extends Chart.controllers.radar {}

  RadarWithShadow.id = "radarWithShadow";
  RadarWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(RadarWithShadow);

  // PolarArea with shadow
  class PolarAreaWithShadow extends Chart.controllers.polarArea {}

  PolarAreaWithShadow.id = "polarAreaWithShadow";
  PolarAreaWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(PolarAreaWithShadow);

  // Line with annotation
  class LineWithAnnotation extends Chart.controllers.line {
    draw(ease) {
      const ctx = this.chart.ctx;

      Chart.controllers.line.prototype.draw.call(this, ease);

      if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
        const activePoint = this.chart.tooltip._active[0];
        const x = activePoint.element.x;
        const topY = this.chart.scales["y"].top;
        const bottomY = this.chart.scales["y"].bottom;

        ctx.save();
        ctx.beginPath();
        ctx.moveTo(x, topY);
        ctx.lineTo(x, bottomY);
        ctx.lineWidth = 1;
        ctx.strokeStyle = "rgb(" + colors.primary + "/ .25)";
        ctx.stroke();
        ctx.restore();
      }
    }
  }

  LineWithAnnotation.id = "lineWithAnnotation";

  Chart.register(LineWithAnnotation);

  // Line with annotation and shadow
  class LineWithAnnotationAndShadow extends Chart.controllers.line {
    draw(ease) {
      const ctx = this.chart.ctx;

      Chart.controllers.line.prototype.draw.call(this, ease);

      if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
        const activePoint = this.chart.tooltip._active[0];
        const x = activePoint.element.x;
        const topY = this.chart.scales["y"].top;
        const bottomY = this.chart.scales["y"].bottom;

        ctx.save();
        ctx.beginPath();
        ctx.moveTo(x, topY);
        ctx.lineTo(x, bottomY);
        ctx.lineWidth = 1;
        ctx.strokeStyle = "rgb(" + colors.primary + "/ .25)";
        ctx.stroke();
        ctx.restore();
      }
    }
  }

  LineWithAnnotationAndShadow.id = "lineWithAnnotationAndShadow";
  LineWithAnnotationAndShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(LineWithAnnotationAndShadow);

  // CHARTS
  let ctx = "";

  // DASHBOARD
  // Visitors chart
  ctx = document.getElementById("visitorsChart");

  if (ctx) {
    ctx = ctx.getContext("2d");

    let gradientBackground = ctx.createLinearGradient(0, 0, 0, 450);
    gradientBackground.addColorStop(0, "rgb(" + colors.primary + "/ .5)");
    gradientBackground.addColorStop(0.75, "rgb(" + colors.primary + "/ 0)");

    var visitorsChart = new Chart(ctx, {
      type: "lineWithShadow",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            data: [6.25, 7.5, 10, 7.5, 10, 12.5, 10, 12.5, 10, 12.5, 15, 16.25],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            // backgroundColor: gradientBackground,
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
              color: "rgb(" + colors.primary + "/ .25)",
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (visitorsChart) {
      const datasets = visitorsChart.data.datasets[0];

      datasets.backgroundColor = "rgb(" + colors.primary + "/ .1)";
      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      visitorsChart.options.plugins.tooltip.borderColor =
        "rgb(" + colors.primary + ")";
      visitorsChart.options.plugins.tooltip.titleColor =
        "rgb(" + colors.primary + ")";

      visitorsChart.options.scales.y.grid.color =
        "rgb(" + colors.primary + "/ .25)";

      visitorsChart.update();
    }
  });

  // Categories chart
  ctx = document.getElementById("categoriesChart");

  if (ctx) {
    ctx.getContext("2d");

    var categoriesChart = new Chart(ctx, {
      type: "polarAreaWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            ticks: {
              display: false,
            },
            grid: {
              color: "rgb(" + colors.primary + "/ .25)",
            },
          },
        },
        layout: {
          padding: 5,
        },
      },
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (categoriesChart) {
      const datasets = categoriesChart.data.datasets[0];

      datasets.backgroundColor = [
        "rgb(" + colors.primary + "/ .1)",
        "rgb(" + colors.primary + "/ .5)",
        "rgb(" + colors.primary + "/ .25)",
      ];
      datasets.borderColor = "rgb(" + colors.primary + ")";

      categoriesChart.options.plugins.tooltip.borderColor =
        "rgb(" + colors.primary + ")";
      categoriesChart.options.plugins.tooltip.titleColor =
        "rgb(" + colors.primary + ")";

      categoriesChart.options.scales.r.grid.color =
        "rgb(" + colors.primary + "/ .25)";

      categoriesChart.update();
    }
  });

  // CHARTS
  // Area chart
  ctx = document.getElementById("areaChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Area chart with shadow
  ctx = document.getElementById("areaChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithShadow",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Bar chart
  ctx = document.getElementById("barChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            label: "Potatoes",
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
          {
            label: "Tomatoes",
            data: [7.5, 10, 17.5, 15, 12.5, 5],
            backgroundColor: "rgb(" + colors.primary + "/ .5)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Bar chart with shadow
  ctx = document.getElementById("barChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "barWithShadow",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            label: "Potatoes",
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
          {
            label: "Tomatoes",
            data: [7.5, 10, 17.5, 15, 12.5, 5],
            backgroundColor: "rgb(" + colors.primary + "/ .5)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Line chart
  ctx = document.getElementById("lineChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 8,
            pointHoverBorderWidth: 2,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Line chart with shadow
  ctx = document.getElementById("lineChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithShadow",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 8,
            pointHoverBorderWidth: 2,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Pie chart
  ctx = document.getElementById("pieChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "pie",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Pie chart with shadow
  ctx = document.getElementById("pieChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "pieWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Doughnut chart
  ctx = document.getElementById("doughnutChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        cutout: "75%",
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Doughnut chart with shadow
  ctx = document.getElementById("doughnutChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "doughnutWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        cutout: "75%",
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Radar chart
  ctx = document.getElementById("radarChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "radar",
      data: {
        labels: ["Drinks", "Snacks", "Lunch", "Dinner"],
        datasets: [
          {
            label: "Potatoes",
            data: [25, 25, 25, 25],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
          {
            label: "Tomatoes",
            data: [15, 15, 0, 15],
            backgroundColor: "rgb(" + colors.primary + "/ .25",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            max: 30,
            ticks: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Radar chart with shadow
  ctx = document.getElementById("radarChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "radarWithShadow",
      data: {
        labels: ["Drinks", "Snacks", "Lunch", "Dinner"],
        datasets: [
          {
            label: "Potatoes",
            data: [25, 25, 25, 25],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
          {
            label: "Tomatoes",
            data: [15, 15, 0, 15],
            backgroundColor: "rgb(" + colors.primary + "/ .25",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            max: 30,
            ticks: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Polar chart
  ctx = document.getElementById("polarChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "polarArea",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            ticks: {
              display: false,
            },
          },
        },
        layout: {
          padding: 5,
        },
      },
    });
  }

  // Polar chart with shadow
  ctx = document.getElementById("polarChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "polarAreaWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            ticks: {
              display: false,
            },
          },
        },
        layout: {
          padding: 5,
        },
      },
    });
  }

  // Line with annotation plugin
  const lineWithAnnotationPlugin = {
    afterInit: (chart) => {
      const info = chart.canvas.parentNode;

      const value = chart.data.datasets[0].data[0];
      const heading = chart.data.datasets[0].label;
      const label = chart.data.labels[0];

      info.querySelector(".chart-heading").innerHTML = heading;
      info.querySelector(".chart-value").innerHTML = "$" + value;
      info.querySelector(".chart-label").innerHTML = label;
    },
  };

  // Line with annotation options
  const lineWithAnnotationOptions = {
    plugins: {
      legend: {
        display: false,
      },
      tooltip: {
        enabled: false,
        intersect: false,
        external: (ctx) => {
          const info = ctx.chart.canvas.parentNode;

          const value = ctx.tooltip.dataPoints[0].formattedValue;
          const heading = ctx.tooltip.dataPoints[0].dataset.label;
          const label = ctx.tooltip.dataPoints[0].label;

          info.querySelector(".chart-heading").innerHTML = heading;
          info.querySelector(".chart-value").innerHTML = "$" + value;
          info.querySelector(".chart-label").innerHTML = label;
        },
      },
    },
    scales: {
      y: {
        display: false,
      },

      x: {
        display: false,
      },
    },
    layout: {
      padding: {
        left: 5,
        right: 5,
        top: 10,
        bottom: 10,
      },
    },
  };

  // Line with annotation chart 1
  ctx = document.getElementById("lineWithAnnotationChart1");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart1 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Total Orders",
            data: [1250, 1300, 1550, 900, 1800, 1100, 1600],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart1) {
      const datasets = lineWithAnnotationChart1.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart1.update();
    }
  });

  // Line with annotation chart 2
  ctx = document.getElementById("lineWithAnnotationChart2");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart2 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Active Orders",
            data: [100, 125, 75, 125, 100, 75, 75],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }
  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart2) {
      const datasets = lineWithAnnotationChart2.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart2.update();
    }
  });

  // Line with annotation chart 3
  ctx = document.getElementById("lineWithAnnotationChart3");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart3 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Pending Orders",
            data: [300, 300, 600, 700, 600, 300, 300],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart3) {
      const datasets = lineWithAnnotationChart3.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart3.update();
    }
  });

  // Line with annotation chart 4
  ctx = document.getElementById("lineWithAnnotationChart4");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart4 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Shipped Orders",
            data: [200, 400, 200, 500, 100, 100, 400],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart4) {
      const datasets = lineWithAnnotationChart4.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart4.update();
    }
  });

  // Line with annotation and shadow chart 1
  ctx = document.getElementById("lineWithAnnotationAndShadowChart1");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Total Orders",
            data: [1250, 1300, 1550, 900, 1800, 1100, 1600],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // Line with annotation and shadow chart 2
  ctx = document.getElementById("lineWithAnnotationAndShadowChart2");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Active Orders",
            data: [100, 125, 75, 125, 100, 75, 75],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // Line with annotation and shadow chart 3
  ctx = document.getElementById("lineWithAnnotationAndShadowChart3");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Pending Orders",
            data: [300, 300, 600, 700, 600, 300, 300],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // Line with annotation and shadow chart 4
  ctx = document.getElementById("lineWithAnnotationAndShadowChart4");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Shipped Orders",
            data: [200, 400, 200, 500, 100, 100, 400],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }
}

// Custom File Input
const customFileInput = () => {
  on("body", "change", 'input[type="file"]', (event) => {
    const filename = event.target.value.split("\\").pop();
    event.target.parentNode.querySelector(".file-name").innerHTML = filename;
  });
};

customFileInput();

// Fullscreen
const fullscreen = () => {
  const fullScreenToggler = document.getElementById("fullScreenToggler");

  if (!fullScreenToggler) return;

  const element = document.documentElement;

  // Open fullscreen
  const openFullscreen = () => {
    if (element.requestFullscreen) {
      element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
      element.webkitRequestFullscreen();
    } else if (element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }
  };

  // Close fullscreen
  const closeFullscreen = () => {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    }
  };

  // Check fullscreen
  const checkFullscreen = () => {
    if (
      document.fullscreenElement ||
      document.webkitFullscreenElement ||
      document.mozFullScreenElement ||
      document.msFullscreenElement
    ) {
      return true;
    }

    return false;
  };

  // Toggle Button Icon
  const togglerBtnIcon = () => {
    if (fullScreenToggler.classList.contains("la-expand-arrows-alt")) {
      fullScreenToggler.classList.remove("la-expand-arrows-alt");
      fullScreenToggler.classList.add("la-compress-arrows-alt");
    } else {
      fullScreenToggler.classList.remove("la-compress-arrows-alt");
      fullScreenToggler.classList.add("la-expand-arrows-alt");
    }
  };

  on("body", "click", "#fullScreenToggler", () => {
    if (checkFullscreen()) {
      closeFullscreen();
    } else {
      openFullscreen();
    }

    togglerBtnIcon();
  });
};

fullscreen();

// Menu
const menu = () => {
  const root = document.documentElement;

  const menuType = localStorage.getItem("menuType");

  const menuBar = document.querySelector(".menu-bar");
  const menuItems = document.querySelector(".menu-items");

  if (!menuBar) return;

  if (menuType) {
    root.classList.add(menuType);
    menuBar.classList.add(menuType);
  }

  // Hide Menu Detail
  const hideMenuDetail = () => {
    menuBar.querySelectorAll(".menu-detail.open").forEach((menuDetail) => {
      hideOverlay();

      if (!menuBar.classList.contains("menu-wide")) {
        menuDetail.classList.remove("open");
      }
    });
  };

  // Hide Menu - When Clicked Elsewhere
  document.addEventListener("click", (event) => {
    if (
      !event.target.closest(".menu-items a") &&
      !event.target.closest(".menu-detail") &&
      !menuBar.classList.contains("menu-wide")
    ) {
      hideMenuDetail();
    }
  });

  // Menu Links
  on(".menu-items", "click", ".link", (event) => {
    const menuLink = event.target.closest(".link");
    const menu = menuLink.dataset.target;
    const selectedMenu = menuBar.querySelector(menu);

    if (selectedMenu && !menuBar.classList.contains("menu-wide")) {
      const isSelectedMenuOpen = selectedMenu.classList.contains("open");

      hideMenuDetail();

      if (selectedMenu && !isSelectedMenuOpen) {
        showOverlay(true);
        selectedMenu.classList.add("open");
      } else {
        hideOverlay();
      }
    }
  });

  // Toggle Menu
  const toggleMenu = () => {
    if (menuBar.classList.contains("menu-hidden")) {
      root.classList.remove("menu-hidden");
      menuBar.classList.remove("menu-hidden");
    } else {
      root.classList.add("menu-hidden");
      menuBar.classList.add("menu-hidden");
    }
  };

  on(".top-bar", "click", "[data-toggle='menu']", (event) => {
    toggleMenu(event);
  });

  // Switch Menu Type
  const switchMenuType = (type) => {
    const openMenu = menuBar.querySelector(".menu-detail.open");

    root.classList.remove("menu-icon-only");
    menuBar.classList.remove("menu-icon-only");

    root.classList.remove("menu-wide");
    menuBar.classList.remove("menu-wide");
    deactivateWide();

    root.classList.remove("menu-hidden");
    menuBar.classList.remove("menu-hidden");

    switch (type) {
      case "icon-only":
        root.classList.add("menu-icon-only");
        menuBar.classList.add("menu-icon-only");
        localStorage.setItem("menuType", "menu-icon-only");

        if (openMenu) {
          showOverlay(true);
        }

        break;
      case "wide":
        root.classList.add("menu-wide");
        menuBar.classList.add("menu-wide");
        localStorage.setItem("menuType", "menu-wide");

        activateWide();

        if (openMenu) {
          hideOverlay();
        }

        break;
      case "hidden":
        root.classList.add("menu-hidden");
        menuBar.classList.add("menu-hidden");
        localStorage.setItem("menuType", "menu-hidden");

        hideMenuDetail();

        break;
      default:
        localStorage.removeItem("menuType");

        if (openMenu) {
          showOverlay(true);
        }
    }
  };

  // Activate Wide
  const activateWide = () => {
    menuBar.querySelector(".menu-header").classList.remove("hidden");

    menuBar.querySelectorAll(".menu-items .link").forEach((menuLink) => {
      const target = menuLink.dataset.target;

      const selectedMenu = menuBar.querySelector(".menu-detail" + target);
      if (selectedMenu) {
        selectedMenu.classList.add("collapse");
        menuLink.setAttribute("data-toggle", "collapse");
        menuLink.after(selectedMenu);
      }
    });
  };

  // Deactivate Wide
  const deactivateWide = () => {
    root.classList.remove("menu-wide");
    menuBar.classList.remove("menu-wide");

    menuBar.querySelector(".menu-header").classList.add("hidden");

    menuBar.querySelectorAll(".menu-items .link").forEach((menuLink) => {
      const target = menuLink.dataset.target;

      const selectedMenu = menuBar.querySelector(".menu-detail" + target);
      if (selectedMenu) {
        selectedMenu.classList.remove("collapse");
        menuLink.removeAttribute("data-toggle", "collapse");
        menuItems.after(selectedMenu);
      }
    });
  };

  // Auto-activate Wide
  if (menuBar.classList.contains("menu-wide")) {
    activateWide();
  }

  on(".menu-bar", "click", "[data-toggle='menu-type']", (event) => {
    const type = event.target.closest("[data-toggle='menu-type']").dataset
      .value;
    switchMenuType(type);
  });

  on("#customizer", "click", "[data-toggle='menu-type']", (event) => {
    const type = event.target.closest("[data-toggle='menu-type']").dataset
      .value;
    switchMenuType(type);
  });
};

menu();

// Show Active Page
const showActivePage = () => {
  const pageUrl = window.location.href.split(/[?#]/)[0];

  const pageLinkSelector = ".menu-bar a";

  const pageLinks = document.querySelectorAll(pageLinkSelector);

  if (!pageLinks) return;

  pageLinks.forEach((pageLink) => {
    if (pageLink.href === pageUrl) {
      pageLink.classList.add("active");

      const mainMenuTrigger = pageLink.closest(".menu-detail");

      if (!mainMenuTrigger) return;

      const mainMenu = document.querySelector(
        '.menu-items .link[data-target="[data-menu=' +
          mainMenuTrigger.dataset.menu +
          ']"]'
      );

      mainMenu.classList.add("active");
    }
  });
};

showActivePage();

// Modal
const modal = () => {
  const selector = '[data-toggle="modal"]';

  // Show
  const showModal = (modal) => {
    showOverlay();
    modal.classList.add("active");
    const animation = modal.dataset.animations.split(", ")[0];
    const modalContent = modal.querySelector(".modal-content");
    animateCSS(modalContent, animation);

    modal.addEventListener("click", (event) => {
      if (modal.dataset.staticBackdrop !== undefined) return;
      if (modal !== event.target) return;
      closeModal(modal);
    });
  };

  on("body", "click", selector, (event) => {
    const modalTrigger = event.target.closest(selector);
    const modal = document.querySelector(modalTrigger.dataset.target);
    showModal(modal);
  });

  // Close
  const closeModal = (modal) => {
    hideOverlay();
    const animation = modal.dataset.animations.split(", ")[1];
    const modalContent = modal.querySelector(".modal-content");
    animateCSS(modalContent, animation).then(() => {
      modal.classList.remove("active");
    });
  };

  on(".modal", "click", '[data-dismiss="modal"]', (event) => {
    const modal = event.target.closest(".modal");
    closeModal(modal);
  });
};

modal();

// Overlay
// Show
const showOverlay = (workspace) => {
  if (document.querySelector(".overlay")) return;

  document.body.classList.add("overlay-show");

  const overlay = document.createElement("div");
  if (workspace) {
    overlay.setAttribute("class", "overlay overlay_workspace");
  } else {
    overlay.setAttribute("class", "overlay");
  }

  document.body.appendChild(overlay);
  overlay.classList.add("active");
};

// Hide
const hideOverlay = () => {
  overlayToRemove = document.querySelector(".overlay");

  if (!overlayToRemove) return;

  document.body.classList.remove("overlay-show");

  overlayToRemove.classList.remove("active");
  document.body.removeChild(overlayToRemove);
};

// Rating Stars
const ratingStars = () => {
  rateStars = (event) => {
    const starsContainer = event.target.closest(".rating-stars");
    const stars = Array.from(starsContainer.children);
    const totalStars = stars.length;
    const index = stars.indexOf(event.target);
    let count = 0;
    count = totalStars - index;
    stars.forEach((star) => star.classList.remove("active"));

    event.target.classList.add("active");

    console.log("You have rated " + count + " stars.");
  };

  on("body", "click", ".rating-stars", (event) => {
    rateStars(event);
  });
};

ratingStars();

// Show Password
const showPassword = () => {
  // Toggle Show Password
  const toggleShowPassword = (showPasswordBtn) => {
    const password = showPasswordBtn
      .closest(".form-control-addon-within")
      .querySelector("input");

    if (password.type === "password") {
      password.type = "text";
      showPasswordBtn.classList.remove("text-gray-600", "dark:text-gray-600");
      showPasswordBtn.classList.add("text-primary", "dark:text-primary");
    } else {
      password.type = "password";
      showPasswordBtn.classList.remove("text-primary", "dark:text-primary");
      showPasswordBtn.classList.add("text-gray-600", "dark:text-gray-600");
    }
  };

  on("body", "click", '[data-toggle="password-visibility"]', (event) => {
    const showPasswordBtn = event.target.closest(
      '[data-toggle="password-visibility"]'
    );
    toggleShowPassword(showPasswordBtn);
  });
};

showPassword();

// Sidebar
const sidebar = () => {
  // Toggle Sidebar
  const toggleSidebar = () => {
    const sidebar = document.querySelector(".sidebar:not(.sidebar_customizer)");
    if (sidebar.classList.contains("open")) {
      sidebar.classList.remove("open");
      hideOverlay();
    } else {
      sidebar.classList.add("open");
      showOverlay(true);
    }
  };

  on("body", "click", '[data-toggle="sidebar"]', () => {
    toggleSidebar();
  });
};

sidebar();

// Tabs
const tabs = () => {
  let toggling = false;

  on("body", "click", '[data-toggle="tab"]', (event) => {
    const trigger = event.target.closest('[data-toggle="tab"]');

    const tabs = trigger.closest(".tabs");
    const activeTabTrigger = tabs.querySelector(".tab-nav .active");
    const activeTab = tabs.querySelector(".collapse.open");
    const targetedTab = tabs.querySelector(trigger.dataset.target);

    if (toggling) return;
    if (activeTabTrigger === trigger) return;

    // Trigger
    activeTabTrigger.classList.remove("active");
    trigger.classList.add("active");

    // Tab
    // Close
    toggling = true;

    closeCollapse(activeTab, () => {
      openCollapse(targetedTab, () => {
        toggling = false;
      });
    });
  });

  // Wizard (Previous/Next)
  on("body", "click", '[data-toggle="wizard"]', (event) => {
    const wizard = event.target.closest(".wizard");
    const direction = event.target.dataset.direction;
    const tabLinks = wizard.querySelectorAll(".nav-link");
    const activeLink = wizard.querySelector(".nav-link.active");

    let activeIndex = 0;

    tabLinks.forEach((link, index) => {
      if (link === activeLink) {
        activeIndex = index;
      }
    });

    switch (direction) {
      case "next":
        if (tabLinks[activeIndex + 1]) {
          tabLinks[activeIndex + 1].click();
        }
        break;
      case "previous":
        if (tabLinks[activeIndex - 1]) {
          tabLinks[activeIndex - 1].click();
        }
        break;
    }
  });
};

tabs();

// Tippy
const customTippy = () => {
  // Menu tooltip
  tippy.delegate("body", {
    target: '.menu-icon-only [data-toggle="tooltip-menu"]',
    touch: ["hold", 500],
    theme: "light-border tooltip",
    offset: [0, 12],
    interactive: true,
    animation: "scale",
    placement: "right",
    appendTo: () => document.body,
  });

  // General tooltip
  tippy('[data-toggle="tooltip"]', {
    theme: "light-border tooltip",
    touch: ["hold", 500],
    offset: [0, 12],
    interactive: true,
    animation: "scale",
  });

  // Popover
  tippy('[data-toggle="popover"]', {
    theme: "light-border popover",
    offset: [0, 12],
    interactive: true,
    allowHTML: true,
    trigger: "click",
    animation: "shift-toward-extreme",
    content: (reference) => {
      const title = reference.dataset.popoverTitle;
      const content = reference.dataset.popoverContent;
      const popover =
        "<h5>" + title + "</h5>" + '<div class="mt-5">' + content + "</div>";
      return popover;
    },
  });

  // Dropdown
  tippy('[data-toggle="dropdown-menu"]', {
    theme: "light-border",
    zIndex: 25,
    offset: [0, 8],
    arrow: false,
    placement: "bottom-start",
    interactive: true,
    allowHTML: true,
    animation: "shift-toward-extreme",
    content: (reference) => {
      let dropdownMenu = reference
        .closest(".dropdown")
        .querySelector(".dropdown-menu");
      dropdownMenu = dropdownMenu.outerHTML;
      return dropdownMenu;
    },
  });

  // Custom Dropdown
  tippy('[data-toggle="custom-dropdown-menu"]', {
    theme: "light-border",
    zIndex: 25,
    offset: [0, 8],
    arrow: false,
    placement: "bottom-start",
    interactive: true,
    allowHTML: true,
    animation: "shift-toward-extreme",
    content: (reference) => {
      let dropdownMenu = reference
        .closest(".dropdown")
        .querySelector(".custom-dropdown-menu");
      dropdownMenu = dropdownMenu.outerHTML;
      return dropdownMenu;
    },
  });

  // Search & Select
  tippy('[data-toggle="search-select"]', {
    theme: "light-border",
    offset: [0, 8],
    maxWidth: "none",
    arrow: false,
    placement: "bottom-start",
    trigger: "click",
    interactive: true,
    allowHTML: true,
    animation: "shift-toward-extreme",
    content: (reference) => {
      let dropdownMenu = reference
        .closest(".search-select")
        .querySelector(".search-select-menu");
      dropdownMenu = dropdownMenu.outerHTML;
      return dropdownMenu;
    },
    appendTo(reference) {
      return reference.closest(".search-select");
    },
  });
};

customTippy();

// Toasts
const toasts = () => {
  const toastsContainer = document.getElementById("toasts-container");

  const toastCloseSelector = '[data-dismiss="toast"]';

  // Toast
  const createToast = (toast) => {
    const title = toast.dataset.title;
    const content = toast.dataset.content;
    const time = toast.dataset.time;
    let newToast =
      '<div class="toast mb-5">' +
      '<div class="toast-header">' +
      "<h5>" +
      title +
      "</h5>" +
      "<small>" +
      time +
      "</small>" +
      '<button type="button" class="close" data-dismiss="toast">&times</button>' +
      "</div>" +
      '<div class="toast-body">' +
      content +
      "</div>" +
      "</div>";

    newToast = new DOMParser().parseFromString(newToast, "text/html").body
      .firstChild;

    toastsContainer.appendChild(newToast);
    animateCSS(newToast, "fadeInUp");
  };

  on("body", "click", '[data-toggle="toast"]', (event) => {
    const toast = event.target;
    createToast(toast);
  });

  // Close Toast
  const closeToast = (toast) => {
    toast.style.overflowY = "hidden";
    toast.style.height = toast.offsetHeight + "px";

    animateCSS(toast, "fadeOutUp").then(() => {
      toast.style.transitionProperty =
        "height, margin, padding, border, opacity";
      toast.style.transitionDuration = "200ms";
      toast.style.transitionTimingFunction = "linear";

      toast.style.opacity = 0;
      toast.style.height = 0;
      toast.style.marginTop = 0;
      toast.style.marginBottom = 0;
      toast.style.paddingTop = 0;
      toast.style.paddingBottom = 0;
      toast.style.border = 0;
    });

    toast.addEventListener(
      "transitionend",
      () => {
        toast.parentNode ? toast.parentNode.removeChild(toast) : false;
      },
      { once: true }
    );
  };

  on("body", "click", toastCloseSelector, (event) => {
    const toast = event.target.closest(".toast");
    closeToast(toast);
  });
};

toasts();
