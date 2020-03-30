import axios from 'axios';

const state = {
	all : [],
	allfeaturepost : [],
	list: [],
	total: 0,
	per_page: 5,
	page: 1,
	single_item: ''
};

const getters = {
	getCate : (state ,catid ) => {
		return 'dasdasd';
	}
};

const actions = {
	getAllFeatPost({commit}) {
		axios.get('/api/all-feature-post')
		  .then(function (response) {  
		  	console.log(response);
		    commit('setAllFeaturePost' , response.data.list_post);
		  })
	},
	getAllPost({commit}) {
		axios.get('/api/all-post')
		  .then(function (response) {  
		  	//console.log(response);
		    commit('setAllPost' , response.data.list_post);
		    commit('setTotalList' , response.data.total)
		  })
	},
	getPost({commit},postid) {
		axios.get('/api/get-post/'+postid)
		  .then(function (response) {  
		  	console.log(response);
		    commit('setPost' , response.data.post)
		  })
	},
	getAllPostWithPag({commit ,state}) {
		//console.log(state);
		axios.get('/api/list-post/'+state.per_page+'/'+state.page)
		  .then(function (response) {  
		  	//console.log(response);
		  	commit('setTotalList' , response.data.total);
		    commit('setListPost' , response.data.list_post)
		  })
	},
	
	searchPost({ commit, dispatch, state }, post_keyword){
		if (post_keyword) {
			axios.get('/api/all-post')
			  .then(function (response) {  
			  	//console.log(response);
			  	let list_post = response.data.list_post;
			  	let result_list=list_post.filter((item) => {
					return item.title.indexOf(post_keyword) !== -1;
				});
			    commit('setListPost' , result_list);
			    commit('setPage' , 0);
			  })

		}else{
			commit('setPage' , 1);
			dispatch('getAllPostWithPag');
		}
	},
	setPage({ commit, dispatch, state }, page){ 
		commit('setPage' , page);
		dispatch('getAllPostWithPag');
	},
	setPerPage({ commit, dispatch, state }, per_page){ 
		commit('setPerPage' , per_page)
	}

};
const mutations = {
	setAllFeaturePost (state, all) {
		state.allfeaturepost = all
	},
	setAllPost (state, all) {
		state.all = all
	},
	setListPost (state, list_post) {
		state.list = list_post
	},
	setPost (state, category) {
		state.single_item = category
	},
	setTotalList (state, total) {
		state.total = total
	},
	setPage (state, page){
		state.page = page
	},
	setPerPage (state, per_page){
		state.per_page = per_page
	}
};





export default {
  namespaced : true,	
  state,
  actions,
  getters,
  mutations
}
