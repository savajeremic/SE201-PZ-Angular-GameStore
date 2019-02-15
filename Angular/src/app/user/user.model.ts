export class User {
    id: number;
    username: string;
    password: string;
    email: string;
    token: number;
    type_id: number;
    type_name: string;
    name: string;
    surname: string;
    avatar: string;
    birth_date: string;
    country: string;
    
    constructor(
      id: number,
      username: string,
      password: string,
      email: string,
      token: number,
      type_id: number,
      type_name: string,
      name?: string,
      surname?: string,
      avatar?: string,
      birth_date?: string,
      country?: string,
    ) { }
}
