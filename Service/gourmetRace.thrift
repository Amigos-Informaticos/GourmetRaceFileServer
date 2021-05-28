namespace php fileservice

typedef i32 int

struct Image {
	1: binary file,
	2: string path
}

exception FileError {
	1: int errorCode,
	2: string description
}

service GalleryService {
	int saveFiles(1:list<Image> images) throws (1: FileError error),
	list<binary> getFiles(1:list<string> paths)  throws (1: FileError error),
	int deleteFiles(1:list<string> paths) throws (1: FileError error)
}