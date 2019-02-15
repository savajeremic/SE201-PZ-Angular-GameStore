
export class Game {
  id: number;
  name: string;
  company_name: string;
  game_genre: string;
  language_name: string;
  description: string;
  votes: string;
  cover: string;
  version: string;
  rating: string;
  release_date: string;
  size: string;
  price: number;
  isAdded: boolean;

  constructor(
    id: number,
    name: string,
    company_name: string,
    game_genre: string,
    language_name: string,
    description: string,
    votes: string,
    cover: string,
    version: string,
    rating: string,
    release_date: string,
    size: string,
    price: number,
    isAdded: boolean
  ) {}
}
