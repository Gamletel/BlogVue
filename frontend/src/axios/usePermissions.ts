import axiosInstance from "@/axios/axios";

export default function usePermissions() {
  const indexPermissions = async () => {
    try {
      const response = await axiosInstance.get("/api/permissions");
      return response.data;
    } catch (error) {
      console.error(error);
      return [];
    }
  }

  const deletePermissions = async (id : number) => {
    try{
      const response = await axiosInstance.delete(`/api/permissions/${id}`);
      return response.data;
    }catch(error){
      console.error(error);
      return null;
    }
  }

  return {
    indexPermissions,
    deletePermissions,
  }
}
