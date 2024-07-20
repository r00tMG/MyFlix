// src/services/favoriteService.js


import axios from "axios";

export const getFavorites = async () => {
    const token = localStorage.getItem('token')
    const response = await axios.get('http://localhost:8000/api/favorites',{
        headers: {
            'Authorization' : `Bearer ${token}`
        }
    });
    return response.data;
};

export const addFavorite = async (filmId) => {
    const token = localStorage.getItem('token')
    const response = await axios.post('http://localhost:8000/api/favorites', { film_id: filmId },{
        headers: {
            'Authorization': `Bearer ${token}`
        }
        });
    //console.log(response.data)
    return response.data;
};

export const removeFavorite = async (filmId) => {
    const token = localStorage.getItem('token')
   const r = await axios.delete(`http://localhost:8000/api/favorites/${filmId}`,{
        headers:{
            'Authorization': `Bearer ${token}`
        }
    });
    //console.log(r)
};
