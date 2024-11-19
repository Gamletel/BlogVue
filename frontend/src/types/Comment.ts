export interface Comment{
  id: number,
  user_id: number,
  post_id:number,
  rating:number,
  title:string|null,
  text:string|null,
  created_at: string|null,
  updated_at: string|null,
}
