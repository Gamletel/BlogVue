import axiosInstance from "@/axios/axios";

export default function useRolePermissions() {
  const indexRolePermissions = async ()  => {
    try{
      const response = await axiosInstance.get('api/role-permissions');

      return response.data;
    }catch(err){
      console.error(err);
      return [];
    }
  }

  return {
    indexRolePermissions,
  }
}
