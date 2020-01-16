const movies = document.getElementById('movies');

if(movies){
	movies.addEventListener('click',(e)=>{
		if(e.target.className === 'btn btn-danger delete-movie'){
			if(confirm('Are you sure?')){
				const id = e.target.getAttribute('data-id');
				fetch(`/movie/delete/${id}`,{method: 'DELETE'}).then(res => window.location.reload());
			}
		}
	})
}