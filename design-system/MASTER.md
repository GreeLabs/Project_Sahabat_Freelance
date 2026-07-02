# RemakeFreelance Neo-Brutalism Design System

## Direction

- Product: freelance marketplace for Admin, Mitra, and User roles.
- Style: functional neo-brutalism, bold but still suitable for data-heavy dashboards.
- Principles: high contrast, obvious actions, strong hierarchy, accessible interaction states, and mobile-first layouts.

## Color Tokens

| Token | Value | Usage |
| --- | --- | --- |
| Ink | `#111111` | Text, borders, dark surfaces |
| Paper | `#FFFDF2` | Main page background |
| Surface | `#FFFFFF` | Cards, inputs, menus |
| Primary | `#FFE500` | Main CTA, active navigation |
| Accent | `#6C5CE7` | Informational emphasis |
| Cyan | `#38D9F5` | Secondary highlight |
| Success | `#42D392` | Success state |
| Warning | `#FFB703` | Warning state |
| Danger | `#FF5C5C` | Destructive action and errors |
| Muted | `#5E6472` | Secondary copy |

Never use color as the only status indicator. Pair it with text or an icon.

## Typography

- Display: `Bebas Neue`, uppercase for page and section headings only.
- UI labels: `Space Mono`, bold for buttons, navigation, badges, and metadata.
- Body: `IBM Plex Sans`, 16px minimum on mobile, line-height 1.6.
- Keep paragraphs below 75 characters per line where practical.

## Shape And Depth

- Border: 3px solid Ink; 4px for major frames.
- Radius: 0 by default; small 4px radius only for compact status pills when needed.
- Shadows: hard offset shadows, no blur. Use 4px, 6px, or 8px consistently.
- Hover: translate by at most 2px. Pressed state returns to the original plane.

## Components

- Buttons and icon controls have a minimum 44px target.
- Inputs have visible labels and a 48px minimum height.
- Every interactive element has a 3px focus ring with a visible offset.
- Tables live inside horizontally scrollable wrappers on small screens.
- Modals use a 55% black scrim and retain a visible close action.
- Cards only lift when they are interactive. Static cards do not move on hover.

## Layout

- Content max width: 1440px.
- Gutters: 16px mobile, 24px tablet, 32px desktop.
- Spacing follows a 4/8px scale.
- Desktop navigation may use a sidebar. Mobile navigation must remain reachable and must not cause horizontal overflow.

## Motion

- Interaction duration: 120-200ms.
- Animate only transform, opacity, color, and shadow.
- Respect `prefers-reduced-motion` and disable marquee/reveal effects when requested.

## Anti-Patterns

- No emoji as navigation or structural icons.
- No soft blurred shadows, glassmorphism, or arbitrary rounded pills.
- No low-contrast gray text on colored surfaces.
- No placeholder-only form labels.
- No hover-only functionality.
