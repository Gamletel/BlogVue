import axiosInstance from "@/axios/axios";
import type {Comment} from "@/types/Comment";

export default function useComments() {
  const showComment = async (id: number) => {
    try {
      const response = await axiosInstance.get(`/api/comments/${id}`);
      return response.data;
    } catch (e) {
      console.error('Ошибка при получении поста', e);
    }
  }

  const storeComment = async (data: Comment) => {
    try {
      const response = await axiosInstance.post('/api/comments', data);
      return response.data;
    } catch (e) {
      console.error('Ошибка при создании комментария', e);
    }
  }

  const deleteComment = async (id: number) => {
    try {
      return await axiosInstance.delete(`/api/comments/${id}`);
    } catch (e) {
      console.error('Ошибка при удалении поста', e);
    }
  }

  return {
    showComment,
    storeComment,
    deleteComment,
  }
}
