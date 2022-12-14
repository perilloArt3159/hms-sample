export default {
	// Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
	ssr: false,

	// Global page headers: https://go.nuxtjs.dev/config-head
	head:
	{
		title: 'HMS Sample',
		htmlAttrs:
		{
			lang: 'en'
		},
		meta:
		[
			{ charset: 'utf-8' },
			{ name: 'viewport', content: 'width=device-width, initial-scale=1' },
			{ hid: 'description', name: 'description', content: '' },
			{ name: 'format-detection', content: 'telephone=no' }
		],
		link:
		[
			{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
		]
	},

	// Global CSS: https://go.nuxtjs.dev/config-css
	css:
	[
		// SCSS file in the project
		'@/assets/css/main.scss', 
		'@/assets/css/transition.scss', 
	],

	// Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
	plugins:
	[
		//...	
	],

	// Auto import components: https://go.nuxtjs.dev/config-components
	components: true,

	// Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
	buildModules:
	[
		// https://go.nuxtjs.dev/typescript
		'@nuxt/typescript-build',
		'@nuxt/postcss8',
	],

	// Modules: https://go.nuxtjs.dev/config-modules
	modules:
	[
		// https://go.nuxtjs.dev/axios
		'@nuxtjs/axios',
		'@nuxtjs/auth-next'
	],

	auth: 
	{
		strategies:
		{
			laravelSanctum: 
			{
				provider: 'laravel/sanctum',
				url     : 'http://localhost:8000', 
				endpoints: 
				{
					csrf: 
					{
                        url: '/sanctum/csrf-cookie'
                    },
					login : 
					{
						url    : '/api/auth/login', 
						method : 'POST' 
					},
					logout: 
					{
                        url: '/api/auth/logout'
                    },
				}, 
			},
		},

        redirect: 
		{
            login : '/login',
            logout: '/login',
            home  : '/'
        },

		plugins: ['~/plugins/axios'],
	},

	// Axios module configuration: https://go.nuxtjs.dev/config-axios
	axios:
	{
		// Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
		baseURL    : 'http://localhost:8000/api',
		credentials: true,
	},

	// Build Configuration: https://go.nuxtjs.dev/config-build
	build:
	{
		postcss:
		{
			plugins:
			{
				tailwindcss: {},
				autoprefixer: {},
			},
		}
	},
}
