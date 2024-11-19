export interface User{
  id: number,
  name: string,
  email: string,
  password: string,
  avatar: File | null,
  created_at: string | null,
}
