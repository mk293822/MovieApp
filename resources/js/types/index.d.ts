import { Config } from 'ziggy-js';
import { MovieGenreEnums, MovieLanguageEnums } from './enums';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type Movie = {
    id: string; // UUID
    title: string;
    description: string;
    genre: MovieGenreEnums; // Enum for genre
    language: MovieLanguageEnums; // Enum for language
    release_year: string; // Can be Date or string
    director: string; // File path to the director's image/poster
    rating: number; // Rating (e.g., 9.5)
    views: number; // Number of views
    poster_path: string;
    file_path: string; // Path to the movie file (video)
    cover_path: string;
};

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> =
    T & {
        auth: {
            user: User;
            canAddMovies: boolean;
        };
        ziggy: Config & { location: string };
    };
