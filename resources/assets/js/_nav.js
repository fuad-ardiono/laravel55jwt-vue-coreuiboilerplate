export default {
  items: [
    {
      name: 'Dashboard',
      url: '/home/dashboard',
      icon: 'icon-speedometer',
      badge: {
        variant: 'primary',
        text: 'NEW'
      }
    },
    {
      title: true,
      name: 'UI elements'
    },
    {
      name: 'Components',
      url: '/home/components',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'Buttons',
          url: '/home/components/buttons',
          icon: 'icon-puzzle'
        },
        {
          name: 'Social Buttons',
          url: '/home/components/social-buttons',
          icon: 'icon-puzzle'
        },
        {
          name: 'Cards',
          url: '/home/components/cards',
          icon: 'icon-puzzle'
        },
        {
          name: 'Forms',
          url: '/home/components/forms',
          icon: 'icon-puzzle'
        },
        {
          name: 'Modals',
          url: '/home/components/modals',
          icon: 'icon-puzzle'
        },
        {
          name: 'Switches',
          url: '/home/components/switches',
          icon: 'icon-puzzle'
        },
        {
          name: 'Tables',
          url: '/home/components/tables',
          icon: 'icon-puzzle'
        }
      ]
    },
    {
      name: 'Icons',
      url: '/home/icons',
      icon: 'icon-star',
      children: [
        {
          name: 'Font Awesome',
          url: '/home/icons/font-awesome',
          icon: 'icon-star'
        },
        {
          name: 'Simple Line Icons',
          url: '/home/icons/simple-line-icons',
          icon: 'icon-star'
        }
      ]
    },
    {
      name: 'Widgets',
      url: '/home/widgets',
      icon: 'icon-calculator',
      badge: {
        variant: 'danger',
        text: 'NEW'
      }
    },
    {
      name: 'Charts',
      url: '/home/charts',
      icon: 'icon-pie-chart'
    },
    {
      divider: true
    },
    {
      title: true,
      name: 'Extras'
    },
    {
      name: 'Pages',
      url: '/pages',
      icon: 'icon-star',
      children: [
        {
          name: 'Login',
          url: '/login',
          icon: 'icon-star'
        },
        {
          name: 'Register',
          url: '/register',
          icon: 'icon-star'
        },
        {
          name: 'Error 404',
          url: '/404',
          icon: 'icon-star'
        },
        {
          name: 'Error 500',
          url: '/500',
          icon: 'icon-star'
        }
      ]
    }
  ]
}
