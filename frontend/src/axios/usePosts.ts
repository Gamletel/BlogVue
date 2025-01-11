import axiosInstance from "@/axios/axios";
import type {Post} from "@/types/Post";

export default function usePosts() {
  const indexPosts = async () => {
    try {
      const response = await axiosInstance.get('/api/posts');
      console.log('Полученные посты', response.data);
      return response.data;
    } catch (e) {
      console.error('Ошибка при получении постов', e);
      return {};
    }
  }

  const showPost = async (id: number) => {
    try {
      const response = await axiosInstance.get(`/api/posts/${id}`);
      console.log('Пост найден', response.data);
      return response.data;
    } catch (e) {
      console.error('Ошибка при получении поста', e);
      return {};
    }
  }

  const createPost = async (data: Post) => {
    try {
      const response = await axiosInstance.post('/api/posts/create', data);
      console.log('Пост успешно создан!', response.data);
    } catch (e) {
      console.error('Ошибка при создании поста', e);
    }
  }

  const updatePost= async (id: number, data: Post) => {
    try {
      const response = await axiosInstance.patch(`/api/posts/${id}`, data);
      console.log('Пост обновлен', response.data);
    } catch (e) {
      console.error('Ошибка при обновлении поста', e);
    }
  }

  const deletePost = async (id: number) => {
    try {
      const response = await axiosInstance.delete(`/api/posts/${id}`);
      console.log('Пост удален', response.data);
    } catch (e) {
      console.error('Ошибка при удалении поста', e);
    }
  }

  const userPosts = async (id: number) => {
    try {
      const response = await axiosInstance.get(`/api/users/${id}/posts`);
      return response.data;
    } catch (e) {
      console.error('Ошибка при получении постов', e);
    }
  }

  const postComments = async (id: number)=>{
    try{
      const response = await axiosInstance.get(`/api/posts/${id}/get-comments`);
      return response.data;
    } catch (e) {
      console.error('Ошибка при получении комментариев', e);
    }
  }

  return {
    indexPosts,
    showPost,
    createPost,
    updatePost,
    deletePost,
    userPosts,
    postComments,
  };
}
