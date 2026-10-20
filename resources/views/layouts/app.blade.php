<!DOCTYPE html>
<html class="dark" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="web_standard" name="shell-type" />
    <title>@yield('title', 'PT Solusi Koneksi Anda')</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <style>
        @layer base {

            html,
            body {
                margin: 0;
                padding: 0;
            }

            body {
                overscroll-behavior: none;
            }

            main> :first-child {
                margin-top: 0 !important;
            }

            main> :last-child {
                margin-bottom: 0 !important;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Soft page polish */
        .ui-input {
            transition: border-color 160ms ease, background-color 160ms ease, box-shadow 160ms ease;
        }

        .ui-input:focus {
            outline: none;
            border-color: #ff2a4b !important;
            box-shadow: 0 0 0 1px rgba(255, 42, 75, 0.35);
        }

        .ui-link {
            transition: color 160ms ease;
        }

        .ui-card-hover {
            transition: border-color 200ms ease, transform 200ms ease;
        }

        .ui-card-hover:hover {
            border-color: rgba(255, 42, 75, 0.45);
            transform: translateY(-2px);
        }

        @media (prefers-reduced-motion: reduce) {
            .ui-card-hover:hover {
                transform: none;
            }
        }

        /* Floating nav breathing room for first content */
        .nav-float {
            transition: background-color 200ms ease, border-color 200ms ease, box-shadow 200ms ease;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ffb3b3",
                        "secondary-container": "#d6012e",
                        "on-secondary-fixed-variant": "#92001c",
                        "surface-container-highest": "#353437",
                        "on-primary-container": "#5b0011",
                        "primary-fixed": "#ffdad9",
                        "on-surface": "#e5e1e4",
                        "background": "#131315",
                        "outline": "#ad8787",
                        "surface-container-lowest": "#0e0e10",
                        "surface-container-high": "#2a2a2c",
                        "on-error": "#690005",
                        "primary-fixed-dim": "#ffb3b3",
                        "on-tertiary": "#00382c",
                        "surface-dim": "#131315",
                        "on-tertiary-container": "#003026",
                        "on-error-container": "#ffdad6",
                        "surface-variant": "#353437",
                        "inverse-on-surface": "#313032",
                        "secondary-fixed-dim": "#ffb3b1",
                        "on-secondary-container": "#ffe7e5",
                        "on-tertiary-fixed-variant": "#005141",
                        "on-secondary-fixed": "#410007",
                        "secondary": "#ffb3b1",
                        "on-primary-fixed-variant": "#920021",
                        "tertiary": "#66dabb",
                        "tertiary-fixed": "#84f7d6",
                        "primary-container": "#ff5260",
                        "outline-variant": "#5d3f3f",
                        "error": "#ffb4ab",
                        "on-background": "#e5e1e4",
                        "surface-tint": "#ffb3b3",
                        "surface-container-low": "#1c1b1d",
                        "error-container": "#93000a",
                        "surface": "#131315",
                        "surface-bright": "#39393b",
                        "tertiary-fixed-dim": "#66dabb",
                        "on-secondary": "#680011",
                        "on-surface-variant": "#e7bcbc",
                        "on-primary": "#680015",
                        "inverse-primary": "#bf002f",
                        "tertiary-container": "#21a386",
                        "secondary-fixed": "#ffdad8",
                        "surface-container": "#201f21",
                        "on-tertiary-fixed": "#002019",
                        "on-primary-fixed": "#400009",
                        "inverse-surface": "#e5e1e4"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "margin-mobile": "1.25rem",
                        "space-sm": "0.5rem",
                        "gutter-mobile": "1rem",
                        "space-md": "1rem",
                        "margin": "3rem",
                        "space-lg": "1.5rem",
                        "gutter": "1.5rem",
                        "space-xs": "0.25rem",
                        "space-xl": "2.5rem"
                    },
                    fontFamily: {
                        "tech-badge": ["Montserrat", "sans-serif"],
                        "label-caps": ["Montserrat", "sans-serif"],
                        "headline-xl": ["Montserrat", "sans-serif"],
                        "body-lg": ["Montserrat", "sans-serif"],
                        "headline-lg": ["Montserrat", "sans-serif"],
                        "headline-sm": ["Montserrat", "sans-serif"],
                        "display-hero-mobile": ["Montserrat", "sans-serif"],
                        "body-sm": ["Montserrat", "sans-serif"],
                        "display-hero": ["Montserrat", "sans-serif"],
                        "body-md": ["Montserrat", "sans-serif"],
                        "tech-code": ["Montserrat", "sans-serif"],
                        "headline-xl-mobile": ["Montserrat", "sans-serif"],
                        "headline-md": ["Montserrat", "sans-serif"],
                        "sans": ["Montserrat", "sans-serif"]
                    },
                    fontSize: {
                        "tech-badge": ["11px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.08em",
                            "fontWeight": "600"
                        }],
                        "label-caps": ["10px", {
                            "lineHeight": "14px",
                            "letterSpacing": "0.14em",
                            "fontWeight": "700"
                        }],
                        "headline-xl": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "600"
                        }],
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "letterSpacing": "0em",
                            "fontWeight": "600"
                        }],
                        "display-hero-mobile": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "700"
                        }],
                        "body-sm": ["13px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0.01em",
                            "fontWeight": "400"
                        }],
                        "display-hero": ["72px", {
                            "lineHeight": "80px",
                            "letterSpacing": "-0.04em",
                            "fontWeight": "700"
                        }],
                        "body-md": ["15px", {
                            "lineHeight": "24px",
                            "letterSpacing": "0em",
                            "fontWeight": "400"
                        }],
                        "tech-code": ["12px", {
                            "lineHeight": "18px",
                            "letterSpacing": "0.04em",
                            "fontWeight": "500"
                        }],
                        "headline-xl-mobile": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }]
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#0e0e10] font-body-md text-body-md text-on-surface antialiased selection:bg-secondary-container selection:text-on-secondary-container">
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')
</body>

</html>