const state = {
	all : [],
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
	getAllCate({commit}) {
		axios.get('/api/admin/all-category')
		  .then(function (response) {  
		  	//console.log(response);
		    commit('setAllCate' , response.data.list_category);
		    commit('setTotalList' , response.data.total)
		  })
	},
	getCate({commit},catid) {
		axios.get('/api/admin/get-category/'+catid)
		  .then(function (response) {  
		  	console.log(response);
		    commit('setCate' , response.data.category)
		  })
	},
	getAllCateWithPag({commit ,state}) {
		//console.log(state);
		axios.get('/api/admin/list-category/'+state.per_page+'/'+state.page)
		  .then(function (response) {  
		  	//console.log(response);
		    commit('setListCate' , response.data.list_category)
		  })
	},
	removeCate({ commit , dispatch } ,id){
		axios.delete('/api/admin/delete-category/'+id)
			.then(function(response){
				//console.log(response);
				dispatch('getAllCateWithPag');
				Toast.fire({
				  icon: 'success',
				  title: 'Danh mục mới đã xóa'
				})
			})
	},
	searchCate({ commit, dispatch, state }, cate_keyword){
		if (cate_keyword) {
			axios.get('/api/admin/all-category')
			  .then(function (response) {  
			  	console.log(response);
			  	let list_category = response.data.list_category;
			  	let result_list=list_category.filter((item) => {
					return item.title.indexOf(cate_keyword) !== -1;
				});
			    commit('setListCate' , result_list);
			    commit('setPage' , 0);
			  })

		}else{
			commit('setPage' , 1);
			dispatch('getAllCateWithPag');
		}
	},
	setPage({ commit, dispatch, state }, page){ 
		commit('setPage' , page);
		dispatch('getAllCateWithPag');
	},
	setPerPage({ commit, dispatch, state }, per_page){ 
		commit('setPerPage' , per_page)
		dispatch('getAllCateWithPag');
	}

};
const mutations = {
	setAllCate (state, all) {
		state.all = all
	},
	setListCate (state, list_category) {
		state.list = list_category
	},
	setCate (state, category) {
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
