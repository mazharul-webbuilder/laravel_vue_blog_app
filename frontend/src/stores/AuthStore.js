import {defineStore} from "pinia";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: '',
        accessToken: '',
    }),
    getters: {
        isAuthenticated(){
            this.accessToken = localStorage.getItem('accessToken')

            return !!this.accessToken
        }
    },
    actions: {
        setAccessToken(token){
            this.accessToken = token
        },
        setAccessTokenToLocalStorage(token){
            localStorage.setItem('accessToken', token)
        },
        removeAccessToken(){
            localStorage.removeItem('accessToken')
            this.accessToken = ''
        }
    }
})