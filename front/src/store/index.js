// store/index.js

import { createStore } from 'vuex'

export default createStore({
    state: {
        user: null,
        roles: [],
        //permissions: []
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_ROLES(state, roles) {
            state.roles = roles;
        },
       /* SET_PERMISSIONS(state, permissions) {
            state.permissions = permissions;
        }*/
    },
    actions: {
        setUser({ commit }, user) {
            commit('SET_USER', user);
        },
        setRoles({ commit }, roles) {
            commit('SET_ROLES', roles);
        },
        /*setPermissions({ commit }, permissions) {
            commit('SET_PERMISSIONS', permissions);
        }*/
    },
    getters: {
        user: state => state.user,
        roles: state => state.roles,
        //permissions: state => state.permissions,
        hasRole: (state) => (role) => {
            return state.roles.includes(role);
        },
       /* hasPermission: (state) => (permission) => {
            return state.permissions.includes(permission);
        }*/
    }
});
