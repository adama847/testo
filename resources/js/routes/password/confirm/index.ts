// resources/js/routes/password/store.ts

import { 
    queryParams, 
    type RouteQueryOptions, 
    type RouteDefinition, 
    type RouteFormDefinition 
} from '@/wayfinder' // <-- utilise l'alias @ ou adapte selon ton vite.config.ts

/**
 * @see \Laravel\Fortify\Http\Controllers\ConfirmablePasswordController::store
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmablePasswordController.php:51
 * @route '/user/confirm-password'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/user/confirm-password',
} satisfies RouteDefinition<["post"]>

/**
 * @see \Laravel\Fortify\Http\Controllers\ConfirmablePasswordController::store
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
 * @see \Laravel\Fortify\Http\Controllers\ConfirmablePasswordController::store
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
 * Form version of store
 */
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

const confirm = {
    store: Object.assign(store, store),
}

export default confirm
