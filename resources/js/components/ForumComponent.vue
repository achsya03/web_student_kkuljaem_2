<template>
    <div>
        <transition>
        <ul>
            <li v-for="post in laravelData.data" :key="post.post_uuid">{{ post.judul }}</li>
        </ul>
        <!-- <p>{{page}}</p> -->
        </transition>
        <!-- pagination -->
        <!-- <nav aria-label="Page navigation example pt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link page-prev-next" href="#">Prev</a></li>
                <li class="page-item"><a class="page-link page-number" href="#">1</a></li>
                <li class="page-item"><a class="page-link page-number" href="#">...</a></li>
                <li class="page-item"><a class="page-link page-number" href="#">11</a></li>
                <li class="page-item"><a class="page-link page-number active" href="#">12</a></li>
                <li class="page-item"><a class="page-link page-number" href="#">13</a></li>
                <li class="page-item"><a class="page-link page-number" href="#">...</a></li>
                <li class="page-item"><a class="page-link page-number" href="#">15</a></li>
                <li class="page-item"><a class="page-link page-prev-next" href="#">Next</a></li>
            </ul>
        </nav> -->
        <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>
        <!-- End Pagination -->
    </div>
</template>

<script>
const dataPerPage = 5;
export default {
    props: ["data"],
    data() {
        return {
            laravelData: {
                data: this.data
            },
            page: 1,
            totalPage: this.data.length/dataPerPage
        }
    },
    methods: {
        // nextPage: function() {
        //     let startIndex = parseInt(this.page*dataPerPage)
        //     this.page++
        //     let endIndex = parseInt(this.page*dataPerPage)
        //     if (endIndex > this.laravelData.length) {
        //         endIndex = this.laravelData.length
        //     }
        //     console.log(startIndex);
        //     this.laravelData = this.data.slice(startIndex,endIndex)
        // }
        getResults(page = 1) {
			// axios.get('example/results?page=' + page)
			// 	.then(response => {
			// 		this.laravelData = response.data;
			// 	});
		}
    },
    mounted() {
        this.getResults()
    }
}
</script>

