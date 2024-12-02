/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./**/*.php',    // Match all PHP files in the current directory and subdirectories
		'!./node_modules', // Exclude files in the node_modules directory
		'./js/**/*.js',
	],
	theme: {
		extend: {
			colors: {
				"primary": "#409e52",
				"secondary": "#111827",
				"accent": "#52a400",
				"neutral": "#6b7280",
				"base-100": "#ffffff",
				"info": "#ffffff",
				"success": "#16a34a",
				"warning": "#eab308",
				"error": "#e11d48",
				'primary-content': '#ffffff',
				'footer': '#2E2E2E'
			},
		},
	},
	plugins: [
		require('daisyui'),
		require('cssnano')({
			preset: 'default',
		}),
	],
	daisyui: {
		themes: [
			{
				ar_medical: {
					"primary": "#409e52",
					"secondary": "#111827",
					"accent": "#52a400",
					"neutral": "#6b7280",
					"base-100": "#ffffff",
					"info": "#ffffff",
					"success": "#16a34a",
					"warning": "#eab308",
					"error": "#e11d48",
					'primary-content': '#ffffff',
				},
			},
		],
	},
}