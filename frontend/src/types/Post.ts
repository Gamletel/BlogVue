export interface Post{
  id?: number | null,
  user_id: number,
  title: string,
  description: string | null,
  text: string | null,
  created_at?: string | null,
}
