import policies from './policies';
export default {
    install(Vue, options) {
        Vue.prototype.authorize = function(policy, model) {
            if (!window.Auth.loggedIn) return false;
            if (typeof policy === 'string' && typeof model === 'object') {
                let user = window.Auth.user;
                return policies[policy](user, model);
            }
        };
        Vue.prototype.loggedIn = window.Auth.loggedIn;
    }
}