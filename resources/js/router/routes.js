const AdminHome               = () => import('~/pages/admin/home').then(m => m.default || m)
const AdminAuthLogin          = () => import('~/pages/admin/auth/login').then(m => m.default || m)
const AdminAuthPasswordEmail  = () => import('~/pages/admin/auth/password/email').then(m => m.default || m)
const AdminAuthPasswordReset  = () => import('~/pages/admin/auth/password/reset').then(m => m.default || m)

const AdminManagement         = () => import('~/pages/admin/management/index').then(m => m.default || m)
const AdminManagementArtworks = () => import('~/pages/admin/management/artworks').then(m => m.default || m)
const AdminManagementBiography = () => import('~/pages/admin/management/biography').then(m => m.default || m)
const AdminManagementWelcome  = () => import('~/pages/admin/management/welcome').then(m => m.default || m)

const AdminSettings           = () => import('~/pages/admin/settings/index').then(m => m.default || m)
const AdminSettingsProfile    = () => import('~/pages/admin/settings/profile').then(m => m.default || m)
const AdminSettingsPassword   = () => import('~/pages/admin/settings/password').then(m => m.default || m)

const Home = () => import('~/pages/home').then(m => m.default || m)
const Works = () => import('~/pages/artworks').then(m => m.default || m)
const Painting = () => import('~/pages/painting').then(m => m.default || m)
const Photography = () => import('~/pages/photography').then(m => m.default || m)
const Sculpture = () => import('~/pages/sculpture').then(m => m.default || m)
const Video = () => import('~/pages/video').then(m => m.default || m)
const Manifest = () => import('~/pages/manifest').then(m => m.default || m)
const Biography = () => import('~/pages/biography').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

export default [
  { path: '/', redirect: { name: 'artworks.home' } },

  { path: '/artworks',
    name: 'artworks',
    component: Works,
    redirect: { name: 'artworks.home' },
    children: [
      { path: '', name: 'artworks.home', component: Home },
      { path: 'painting', name: 'artworks.painting', component: Painting },
      { path: 'photography', name: 'artworks.photography', component: Photography },
      { path: 'sculpture', name: 'artworks.sculpture', component: Sculpture },
      { path: 'video', name: 'artworks.video', component: Video },
    ]
  },
  { path: '/manifest', name: 'manifest', component: Manifest },
  { path: '/bio', name: 'bio', component: Biography },

  { path: '/admin', name: 'admin', redirect: { name: 'admin.management.artworks' } },
  { path: '/admin/login', name: 'admin.login', component: AdminAuthLogin },
  { path: '/admin/password/reset', name: 'admin.password.request', component: AdminAuthPasswordEmail },
  { path: '/admin/password/reset/:token', name: 'admin.password.reset', component: AdminAuthPasswordReset },

  { path: '/admin/management',
    component: AdminManagement,
    children: [
      { path: '', redirect: { name: 'admin.management.artworks' } },
      { path: 'artworks', name: 'admin.management.artworks', component: AdminManagementArtworks },
      { path: 'biography', name: 'admin.management.biography', component: AdminManagementBiography },
      { path: 'welcome', name: 'admin.management.welcome', component: AdminManagementWelcome }
    ]
  },

  { path: '/admin/settings',
    component: AdminSettings,
    children: [
      { path: '', redirect: { name: 'admin.settings.profile' } },
      { path: 'profile', name: 'admin.settings.profile', component: AdminSettingsProfile },
      { path: 'password', name: 'admin.settings.password', component: AdminSettingsPassword }
    ]
  },

  { path: '*', redirect: { name: 'artworks' } },
  { path: '/admin/*', redirect: { name: 'admin.login' } }
]
