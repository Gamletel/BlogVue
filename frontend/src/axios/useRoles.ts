import axiosInstance from "@/axios/axios";

export default function useRoles() {
  const indexRoles = async () => {
    try {
      const response = await axiosInstance.get('/api/roles');
      return response.data;
    } catch (err) {
      console.log(err);
      return null;
    }
  }

  const createRoles = async (data: []) => {
    try {
      const response = await axiosInstance.post('/api/roles', data);
      return response.data;
    } catch (err) {
      console.log(err);
      return null;
    }
  }

  const deleteRoles = async (id: number) => {
    try {
      const response = await axiosInstance.delete(`/api/roles/${id}`);
      return response.data;
    } catch (err) {
      console.log(err);
      return null;
    }
  }

  return {
    indexRoles,
    createRoles,
    deleteRoles,
  }
}
