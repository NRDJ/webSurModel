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
