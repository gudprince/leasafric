import { mount } from '@vue/test-utils'
import App from './../src/App.vue'
import BookList from './../src/components/BookList.vue'

describe('App', () => {
	// Inspect the raw component options
	it('has data', () => {
		expect(typeof App.data).toBe('function')
	})
})

describe('BookList', () => {
	// Inspect the raw component options
	it('has data', () => {
		expect(typeof BookList.data).toBe('function')
	})
})