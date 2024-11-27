/* FILTER */
class FilterFilms
{
    init = () =>
    {
        this.filmsNode = document.getElementById('films');
        this.form = document.getElementById('filter');
        this.searchInput = document.getElementById('catalog-search');
        this.sortInput = document.querySelector('.catalog-container select[name="sort"]');
        this.loadMoreBtn = document.querySelector('.catalog-container .js-load-more');

        this.page = 1;

        this.form.addEventListener('submit', this.onSubmit);
        this.sortInput.addEventListener('change', this.getFilms);
        this.searchInput.addEventListener('input', this.onSearch);
        this.loadMoreBtn.addEventListener('click', this.onLoadMore);
    }

    prepareFilterData = (is_search = false) =>
    {
        if (!is_search){
            this.formData = new URLSearchParams(new FormData(this.form))
        } else {
            this.formData = new URLSearchParams()
            this.formData.set('s', this.searchInput.value)
        }

        this.formData.set('action', 'get_films')
        this.formData.set('page', this.page)

        let sort = this.sortInput.value.split('|')

        if (sort.length > 0) {
            this.formData.set('orderby', sort[0])
        }

        if (sort.length > 1) {
            this.formData.set('order', sort[1])
        }

        this.page = 1
    }

    getFilms = async (is_search = false) =>
    {
        this.filmsNode.classList.add( 'is-loading' )

        this.prepareFilterData(is_search)

        const response = await fetch( already.ajaxurl + '?' + this.formData.toString(), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })

        if (response.ok) {
            const data = await response.json()

            if (data){
                this.onSuccess(data)
            }

            this.filmsNode.classList.remove( 'is-loading' )
        }
    }

    onSuccess = (response) =>
    {
        this.filmsNode.innerHTML = response.html;

        if (response.total_count > 2 && response.total_count !== response.current_count)
        {
            this.loadMoreBtn.classList.add('is-show')
        }
        else
        {
            this.loadMoreBtn.classList.remove('is-show')
        }
    }

    onSubmit = (e) =>
    {
        e.preventDefault();

        this.searchInput.value = ''
        this.getFilms()
    }

    onSearch = () =>
    {
        setTimeout(() => {
            this.getFilms(true)
        }, 500)
    }

    onLoadMore = (e) =>
    {
        e.preventDefault()

        let next_page = this.loadMoreBtn.getAttribute('data-page')
        this.page = Number(next_page)+1
        this.loadMoreBtn.setAttribute('data-page', this.page)

        this.getFilms()
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const filterFilms = new FilterFilms();
    filterFilms.init();
});
/* FILTER END */